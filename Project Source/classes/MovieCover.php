<?php
// MovieCover.php

require_once 'movieClass.php';
include '../src/DBconnect.php';

class MovieCover extends movieClass {
    private $coverImage;

    // Constructor that initializes the parent class and the cover image
    public function __construct($movieid, $title, $genre, $ticket_price, $coverImage) {
        parent::__construct($movieid, $title, $genre, $ticket_price);
        $this->coverImage = $coverImage;
    }

    // Getter for cover image filename (returns full path)
    public function getCoverImage() {
        return $this->coverImage;
    }

    // Method to set the cover image filename
    public function setCoverImage($coverImage) {
        $this->coverImage = $coverImage;
    }

    // Static method to fetch all movies with their cover images from the database
    public static function fetchAllMoviesWithCover($Connection) {
        $moviesWithCover = [];
        $query = "SELECT * FROM movies";  // Query to fetch all movies

        // Prepare the query using PDO
        $stmt = $Connection->prepare($query);
        $stmt->execute();

        // Check if any movies were found
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Assume the cover image filename is stored locally using the movie title
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
}
?>
