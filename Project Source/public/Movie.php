<?php
global $connection;
include '../data/config.php';
include '../src/DBconnect.php';
include '../classes/movieClass.php';
include '../classes/MovieCover.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $movie_id = $_GET['id'];

    $movie = MovieCover::fetchCoverByMovieId($connection, $movie_id);
    $genre = $movie->getGenre();
    $relatedMovies = [];

    $sql = "SELECT * FROM movies WHERE genre = :genre AND movieid != :id LIMIT 10";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        ':genre' => $genre,
        ':id' => $movie->getMovieId()
    ]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        $coverImage = strtolower(str_replace(' ', '_', $row['title']));
        $coverImage = preg_replace('/[^a-z0-9_]/', '', $coverImage) . '.jpg';

        $relatedMovies[] = new MovieCover(
            $row['movieid'],
            $row['title'],
            $row['genre'],
            $row['ticket_price'],
            $coverImage
        );
    }
    if (!$movie) {
        die("Movie not found.");
    }
} else {
    die("Invalid movie selection.");
}
?>

<?php include "template/header.php"; ?>
<?php include "template/navbar.php"; ?>

<div class="container">
    <!-- Left Side: Cover and Buy -->
    <div class="moviePageCover-section">
    <div class="movie">
     <?php echo "<img src='" . $movie->getCoverImage() . "' alt='" . htmlspecialchars($movie->getTitle()) . "'>";?>
    </div>

    <div class="buy-button">
        <h1><?php echo htmlspecialchars($movie->getTitle()); ?></h1>

        <p><strong>Genre:</strong> <?php echo htmlspecialchars($movie->getGenre()); ?></p>
        <p><strong>Price:</strong> $<?php echo number_format($movie->getTicketPrice(), 2); ?></p>

        <a href="Booking.php">
             <button type="button">Book Now</button>
         </a>
         <a href="Review.php">
              <button type="button">Write a Review</button>
         </a>
        <a href="index.php">
            <button type="button">Back To Movies</button></a>
    </div>
        <!-- Similar Movies Section -->
        <div class="similar-movies-section">
            <h2 class="textGenre">More in <?php echo htmlspecialchars($genre); ?></h2>
            <div class="scroll-container">
                <?php foreach ($relatedMovies as $related): ?>
                    <div class="movie">
                        <a href="Movie.php?id=<?php echo $related->getMovieId(); ?>">
                            <img src="<?php echo $related->getCoverImage(); ?>" alt="<?php echo htmlspecialchars($related->getTitle()); ?>">
                            <p><?php echo htmlspecialchars($related->getTitle()); ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>



  <?php /////////////////////////////////////////////////////////////THE REVIEW SECTION////////////////////////////////////////////////////////////////////////////////////////////// ?>





        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review_text'], $_POST['moviescore'])) {
            $reviewText = trim($_POST['review_text']);
            $movieScore = (int)$_POST['moviescore'];
            $userId = null;

            if ($reviewText && $movieScore >= 1 && $movieScore <= 10) {
                $insertSql = "INSERT INTO review (review_text, moviescore, movieid, userid)
              VALUES (:review_text, :moviescore, :movieid, :userid)";

                $stmt = $connection->prepare($insertSql);
                $stmt->execute([
                    ':review_text' => $reviewText,
                    ':moviescore' => $movieScore,
                    ':movieid' => $movie_id,
                    ':userid' => $userId
                ]);
            }
        }
        ?>

    <!-- Right Side: Reviews Section -->
        <div class="reviews-section">
            <h3 class="textGenre">Reviews</h3>

            <form method="POST" class="review-form">
                <textarea name="review_text" placeholder="Write your review here..." required></textarea>
                <label for="moviescore">Score (1-10):</label>
                <input type="number" name="moviescore" min="1" max="10" required>
                <button type="submit">Submit Review</button>
            </form>
            <div class="submitted-reviews">
            <?php
            $fetchReviews = $connection->prepare("SELECT * FROM review WHERE movieid = :movieid ORDER BY reviewid DESC");
            $fetchReviews->execute([':movieid' => $movie_id]);
            $reviews = $fetchReviews->fetchAll(PDO::FETCH_ASSOC);

            foreach ($reviews as $r) {
                $score = htmlspecialchars($r['moviescore']);
                $text = htmlspecialchars($r['review_text']);
                if ($r['userid']) {
                    $userDisplay = "User #" . $r['userid'];
                } else {
                    $userDisplay = "Anonymous";
                }
                echo "<div class='review-box'>";
                echo "<strong>$userDisplay</strong> rated it <strong>$score/10</strong><br>";
                echo "<p>$text</p>";
                echo "</div>";
            }
            ?>
        </div>
</div>

</div>

<?php include "template/footer.php" ?>
