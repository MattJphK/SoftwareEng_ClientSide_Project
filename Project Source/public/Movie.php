<?php
global $connection;
include '../data/config.php';
include '../src/DBconnect.php';
include '../classes/movieClass.php';
include '../classes/MovieCover.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $movie_id = $_GET['id'];

    $movie = MovieCover::fetchCoverByMovieId($connection, $movie_id);

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
    <?php echo "<img src='" . $movie->getCoverImage() . "' alt='" . htmlspecialchars($movie->getTitle()) . "'>";?>

    <h1><?php echo htmlspecialchars($movie->getTitle()); ?></h1>

    <p><strong>Genre:</strong> <?php echo htmlspecialchars($movie->getGenre()); ?></p>
    <p><strong>Price:</strong> $<?php echo number_format($movie->getTicketPrice(), 2); ?></p>

    <a href="Booking.php?id=<?php echo $movie->getMovieId(); ?>">
        <button type="button">Book Now</button>
    </a>
    <a href="Review.php">
        <button type="button">Write a Review</button>
    </a>
    <br>
    <a href="index.php">Back to Movies</a>
</div>

<?php include "template/footer.php" ?>
