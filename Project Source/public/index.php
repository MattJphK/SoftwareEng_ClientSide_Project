<?php
global $connection;
include '../data/config.php';
include '../data/common.php';
include '../src/DBconnect.php';
include '../classes/movieClass.php';
include '../classes/MovieCover.php';
$movies = MovieCover::fetchAllMoviesWithCover($connection);
?>

<?php include "template/header.php" ?>
<?php include "template/navbar.php" ?>
<div class="product-container">
    <div class="product-container">
        <?php
        if (count($movies) > 0) {
            foreach ($movies as $movie) {
                echo "<div class='movie'>";


                echo "<a href='Movie.php?id=" . $movie->getMovieId() . "'>";
                echo "<img src='covers/" . $movie->getCoverImage() . "' alt='" . htmlspecialchars($movie->getTitle()) . "'>";
                echo "</a>";
                echo "<h3>" . htmlspecialchars($movie->getTitle()) . "</h3>";
                echo "<p>Genre: " . htmlspecialchars($movie->getGenre()) . "</p>";
                echo "<p>Price: $" . number_format($movie->getTicketPrice(), 2) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No movies available.</p>";
        }
        ?>
    </div>

    <?php include "template/footer.php" ?>
