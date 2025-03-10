<?php

include 'dataconn.php';




// Insert movies into the database
foreach ($movies as $movie) {
    $stmt = $conn->prepare("INSERT INTO movies (movieid, title, genre, ticket_price, coverURL) 
    VALUES (?, ?, ?, ?, ?) 
    ON DUPLICATE KEY UPDATE title = VALUES(title), genre = VALUES(genre), ticket_price = VALUES(ticket_price), coverURL = VALUES(coverURL)");

    $stmt->bind_param("issds", $movie[0], $movie[1], $movie[2], $movie[3], $movie[4]);
    $stmt->execute();
    $stmt->close();
}

// Fetch movies from the database
$sql = "SELECT movieid, title, genre, ticket_price, coverURL FROM movies";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DirectorsCut</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/Index.css">
    <link rel="stylesheet" href="css/Nav.css">

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
        <li><a href="User.php">User</a></li>
        <li><a href="Lab4%20Database.php">Lab4</a></li>
        <li><a href="">Contact</a></li>
    </ul>
</div>
<div class="product-container">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='movie'>";
            echo "<a href='Movie.php?id=" . $row['movieid'] . "'>";
            echo "<img src='" . $row['coverURL'] . "' alt='" . htmlspecialchars($row['title']) . "'>";
            echo "</a>";
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>Genre: " . htmlspecialchars($row['genre']) . "</p>";
            echo "<p>Price: $" . number_format($row['ticket_price'], 2) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No movies available.</p>";
    }
    ?>
</div>
</body>
</html>

<?php
$conn->close();
?>
