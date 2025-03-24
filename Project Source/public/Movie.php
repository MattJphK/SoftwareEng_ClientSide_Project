<?php
include '../data/config.php';
include '../src/DBconnect.php';

// Check if 'id' is set in the URL and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $movie_id = $_GET['id'];

    // Prepare and execute the query to fetch the movie details using PDO
    $stmt = $conn->prepare("SELECT * FROM movies WHERE movieid = :movieid");
    $stmt->bindParam(':movieid', $movie_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the movie details
    $movie = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the movie exists
    if (!$movie) {
        die("Movie not found.");
    }
} else {
    die("Invalid movie selection.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($movie['title']); ?></title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/Index.css">
    <link rel="stylesheet" href="css/Nav.css">
</head>
<body>
<div class="top">
    <div class="logo">
        <a href="index.php" id="leftSitting"><img class="logo_img" src="../images/logo.png" alt="logo" ></a>
    </div>
    <ul>
        <li><a href="index.php">Login</a></li>
        <li><a href="index.php">Register</a></li>
        <li>
            <form class="search-form">
                <input type="text" placeholder="Search..." class="search-input">
                <button type="submit" class="search-btn"><img src="images/icons/loupe.png"></button>
            </form>
        </li>
    </ul>
</div>

<div class="nav">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="../classes/ProductDesc.php">Products</a></li>
        <li><a href="../classes/Review.php">Reviews</a></li>
        <li><a href="Booking.php">Booking</a></li>
        <li><a href="">Contact</a></li>
    </ul>
</div>

<div class="movie-details">
    <img src="<?php echo htmlspecialchars($movie['coverURL']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
    <h1><?php echo htmlspecialchars($movie['title']); ?></h1>
    <p><strong>Genre:</strong> <?php echo htmlspecialchars($movie['genre']); ?></p>
    <p><strong>Price:</strong> $<?php echo number_format($movie['ticket_price'], 2); ?></p>
    <a href="Booking.php">
        <button type="button">Book Now</button>
    </a>
    <a href="../classes/Review.php">
        <button type="button">Write a Review</button>
    </a>
    <br>
    <a href="index.php">Back to Movies</a>
</div>

</body>
</html>
