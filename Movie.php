<?php
include 'dataconn.php'; // Connect to database

// Check if 'id' is set in URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $movie_id = $_GET['id'];

    // Prepare the query to fetch movie details
    $stmt = $conn->prepare("SELECT * FROM movies WHERE movieid = ?");
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a movie is found
    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
    } else {
        die("Movie not found.");
    }

    $stmt->close();
} else {
    die("Invalid movie selection.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/Index.css">
    <link rel="stylesheet" href="css/Nav.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($movie['title']); ?></title>
    <title>Movie Descriptions</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<div class="top">
    <div class="logo">
        <a href="index.php" id="leftSitting"><img class="logo_img" src="images/logo.png" alt="logo" ></a>
    </div>
    <ul>

        <li><a href="index.php">Login</a></li>
        <li><a href="index.php">Register</a></li>
        <li> <form class="search-form">
                <input type="text" placeholder="Search..." class="search-input">
                <button type="submit" class="search-btn"><img src="images/icons/loupe.png"></button>
            </form>
        </li>
    </ul>
</div>
<div class="nav">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="ProductDesc.php">Products</a></li>
        <li><a href="Review.php">Reviews</a></li>
        <li><a href="Booking.php">Booking</a></li>
        <li><a href="">Contact</a></li>
    </ul>
</div>
<div class="movie-details">
    <img src="<?php echo $movie['coverURL']; ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
    <h1><?php echo htmlspecialchars($movie['title']); ?></h1>
    <p><strong>Genre:</strong> <?php echo htmlspecialchars($movie['genre']); ?></p>
    <p><strong>Price:</strong> $<?php echo number_format($movie['ticket_price'], 2); ?></p>
    <a href= "Booking.php">
    <button type="button">Book Now</button>
    </a>
    <a href= "Review.php">
        <button type="button">Write a Review</button>
    </a>

    <br>
    <a href="index.php">Back to Movies</a>
</div>

</body>
</html>
