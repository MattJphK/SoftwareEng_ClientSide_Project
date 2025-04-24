<?php

require_once 'movieClass.php';
require 'coverImageTitleFilter.php';
class MovieCover extends movieClass
{
    private $coverImage; //encapsulation of private variables

    // THIS CLASS FETCHES MOVIE DATA FROM INHERITENCE WHILST HAVING NO DIRECT CONTROL OVER ITS PARENT, therefore aggregation
    public function __construct($movieid, $title, $genre, $ticket_price, $coverImage)
    {
        // Call the parent constructor
        parent::__construct($movieid, $title, $genre, $ticket_price);
        $this->coverImage = $coverImage;
    }

    public function getCoverImage()
    {
        return '../images/moviecovers/' . $this->coverImage;
    }

    public function setCoverImage($coverImage)
    {
        $this->coverImage = $coverImage;
    }

    public static function searchMoviesWithCover($connection, $search)
    {
        $sql = "
        SELECT * FROM movies
        WHERE title LIKE :search OR genre LIKE :search
    ";

        $stmt = $connection->prepare($sql);
        $searchParam = '%' . $search . '%';
        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
        $stmt->execute();

        $movies = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Generate local cover file name from title
            $coverImage = strtolower(str_replace(' ', '_', $row['title']));
            $coverImage = preg_replace('/[^a-z0-9_]/', '', $coverImage);  // Remove invalid characters
            $coverImage .= '.jpg';

            $movies[] = new MovieCover(
                $row['movieid'],
                $row['title'],
                $row['genre'],
                $row['ticket_price'],
                $coverImage
            );
        }

        return $movies;
    }

    public static function fetchAllMoviesWithCover($connection)
    {
        $moviesWithCover = [];
        $query = "SELECT * FROM movies";

        $stmt = $connection->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $coverImage = strtolower(str_replace(' ', '_', $row['title']));
                $coverImage = preg_replace('/[^a-z0-9_]/', '', $coverImage);  // Remove invalid characters
                $coverImage .= '.jpg';
                $movieCover = new MovieCover(
                    $row['movieid'],
                    $row['title'],
                    $row['genre'],
                    $row['ticket_price'],
                    $coverImage
                );

                $moviesWithCover[] = $movieCover;
            }
        }

        return $moviesWithCover;
    }

    public static function fetchCoverByMovieId($connection, $movie_id)
    {
        $query = "SELECT * FROM movies WHERE movieid = :movieid";

        $stmt = $connection->prepare($query);
        $stmt->bindParam(':movieid', $movie_id, PDO::PARAM_INT);
        $stmt->execute();

        $movie = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$movie) {
            return null;
        }

        $coverImage = strtolower(str_replace([' ', ':'], ['_', ''], $movie['title'])) . '.jpg';

        return new MovieCover(
            $movie['movieid'],
            $movie['title'],
            $movie['genre'],
            $movie['ticket_price'],
            $coverImage
        );
    }


}

?>
