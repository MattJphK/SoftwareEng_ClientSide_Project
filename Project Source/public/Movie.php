<?php
global $connection;
include '../data/config.php';
include '../src/DBconnect.php';
include '../classes/movieClass.php';
include '../classes/MovieCover.php';

// Check if 'id' is set in the URL and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $movie_id = $_GET['id'];

    // Fetch the movie details and the cover image using MovieCover class
    $movie = MovieCover::fetchCoverByMovieId($connection, $movie_id);

    // If no movie was found, terminate
    if (!$movie) {
        die("Movie not found.");
    }
} else {
    die("Invalid movie selection.");
}
?>

<?php include "template/header.php"; ?>
<?php include "template/navbar.php"; ?>

<div class="movie-details">
    <!-- Display movie cover and details -->
    <?php echo "<img src='" . $movie->getCoverImage() . "' alt='" . htmlspecialchars($movie->getTitle()) . "'>";?>

    <h1><?php echo htmlspecialchars($movie->getTitle()); ?></h1>

    <p><strong>Genre:</strong> <?php echo htmlspecialchars($movie->getGenre()); ?></p>
    <p><strong>Price:</strong> $<?php echo number_format($movie->getTicketPrice(), 2); ?></p>

    <a href="Booking.php">
        <button type="button">Book Now</button>
    </a>
    <a href="../classes/Review.php">
        <button type="button">Write a Review</button>
    </a>
    <br>
    <a href="index.php">Back to Movies</a>
</div>

<?php include "template/footer.php" ?>
