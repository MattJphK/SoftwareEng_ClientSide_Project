<?php
global $connection;
include '../src/DBconnect.php';
include '../data/config.php';
include 'MovieCover.php';

$movies = MovieCover::fetchAllMovies($connection);

class UnitTest {
    // Define a method to display the movie titles
    public function unitTest($movies) {
        if (count($movies) < 1) {
            echo "<p>No movies found.</p>";
        } else {
            foreach ($movies as $movie) {
                if (method_exists($movie, 'getTitle')) {
                    echo "<h3>" . htmlspecialchars($movie->getTitle()) . "</h3>";
                }
            }
        }
    }
}

$unitTest = new UnitTest($movies);
$unitTest->unitTest($movies);
?>

