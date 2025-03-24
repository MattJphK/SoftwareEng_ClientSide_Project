<?php
// MovieCover.php

require_once 'movieClass.php';

class MovieCover extends movieClass {
    private $coverImage;

    // Constructor that initializes the parent class and the cover image
    public function __construct($movieid, $title, $genre, $ticket_price, $coverImage) {
        // Call the parent constructor
        parent::__construct($movieid, $title, $genre, $ticket_price);
        $this->coverImage = $coverImage;
    }

    // Getter for cover image filename (returns full path)
    public function getCoverImage() {
        // Return the path to the movie cover image inside the 'moviecovers' directory
        return '../images/moviecovers/' . $this->coverImage;
    }

    // Method to set the cover image filename
    public function setCoverImage($coverImage) {
        $this->coverImage = $coverImage;
    }

    // Static method to fetch all movies with their cover images from the database
    public static function fetchAllMoviesWithCover( $connection) {
        $moviesWithCover = [];
        $query = "SELECT * FROM movies";  // Query to fetch all movies

        // Prepare the query using PDO
        $stmt =  $connection->prepare($query);
        $stmt->execute();

        // Check if any movies were found
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Assume the cover image filename is stored locally using the movie title
                // Replace spaces with underscores, make the title lowercase, and remove invalid characters
                $coverImage = strtolower(str_replace(' ', '_', $row['title']));
                $coverImage = preg_replace('/[^a-z0-9_]/', '', $coverImage);  // Remove invalid characters
                $coverImage .= '.jpg';  // Add .jpg extension

                // Create new MovieCover object with the cover image
                $movieCover = new MovieCover(
                    $row['movieid'],
                    $row['title'],
                    $row['genre'],
                    $row['ticket_price'],
                    $coverImage
                );

                $moviesWithCover[] = $movieCover;  // Add to the list of movies with covers
            }
        }

        return $moviesWithCover;
    }
    // Static method to fetch cover image for a specific movie by ID
    public static function fetchCoverByMovieId($connection, $movie_id) {
        $query = "SELECT * FROM movies WHERE movieid = :movieid";

        $stmt = $connection->prepare($query);
        $stmt->bindParam(':movieid', $movie_id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the movie details
        $movie = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the movie exists
        if (!$movie) {
            return null;  // If no movie found, return null
        }

        // Generate the cover image filename based on the movie title
        $coverImage = strtolower(str_replace(' ', '_', $movie['title'])) . '.jpg';
        $coverImage = preg_replace('/[^a-z0-9_]/', '', $coverImage);

        // Return a MovieCover object with the cover image
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
