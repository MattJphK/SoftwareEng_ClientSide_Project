<?php

include 'dataconn.php';


// Movie data array
$movies = [
    [278, "The Shawshank Redemption", "Drama", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/q6y0Go1tsGEsmtFryDOJo3dEmqu.jpg"],
    [238, "The Godfather", "Crime", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/3bhkrj58Vtu7enYsRolD1fZdja1.jpg"],
    [155, "The Dark Knight", "Action", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/qJ2tW6WMUDux911r6m7haRef0WH.jpg"],
    [240, "The Godfather Part II", "Crime", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/hek3koDUyRQk7FIhPXsa6mT2Zc3.jpg"],
    [389, "12 Angry Men", "Drama", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/ppd84D2i9W8jXmsyInGyihiSyqz.jpg"],
    [424, "Schindler's List", "Drama", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/sF1U4EUQS8YHUYjNl3pMGNIQyr0.jpg"],
    [122, "The Lord of the Rings: The Return of the King", "Adventure", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/rCzpDGLbOoPwLjy3OAm5NUPOTrC.jpg"],
    [680, "Pulp Fiction", "Crime", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/d5iIlFn5s0ImszYzBPb8JPIfbXD.jpg"],
    [429, "The Good, the Bad and the Ugly", "Western", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/bX2xnavhMYjWDoZp1VM6VnU1xwe.jpg"],
    [550, "Fight Club", "Drama", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/pB8BM7pdSp6B6Ih7QZ4DrQ3PmJK.jpg"],
    [13, "Forrest Gump", "Drama", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/saHP97rTPS5eLmrLQEcANmKrsFl.jpg"],
    [27205, "Inception", "Action", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/9gk7adHYeDvHkCSEqAvQNLV5Uge.jpg"],
    [120, "The Lord of the Rings: The Fellowship of the Ring", "Adventure", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/6oom5QYQ2yQTMJIbnvbkBL9cHo6.jpg"],
    [1891, "Star Wars: Episode V - The Empire Strikes Back", "Sci-Fi", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/2l05cFWJacyIsTpsqSgH0wQXe4V.jpg"],
    [121, "The Lord of the Rings: The Two Towers", "Adventure", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/5VTN0pR8gcqV3EPUHHfMGnJYN9L.jpg"],
    [603, "The Matrix", "Sci-Fi", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/f89U3ADr1oiB1s9GkdPOEpXUk5H.jpg"],
    [769, "Goodfellas", "Crime", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/aKuFiU82s5ISJpGZp7YkIr3kCUd.jpg"],
    [510, "One Flew Over the Cuckoo's Nest", "Drama", 13.00, "https://m.media-amazon.com/images/M/MV5BYjBkMjgzMzYtNzRiMS00NDc3LWE4YTUtZjYxYjZhNjNhYzhhXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"],
    [346, "Seven Samurai", "Action", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/8OKmBV5BUFzmozIC3pPWKHy17kx.jpg"],
    [807, "Se7en", "Crime", 13.00, "https://image.tmdb.org/t/p/w600_and_h900_bestv2/69Sns8WoET6CfaYlIkHbla4l7nC.jpg"]
];


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
