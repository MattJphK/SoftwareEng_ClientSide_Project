<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change as needed
$password = ""; // Change as needed
$database = "thedirectorsdb"; // Change to your database name

$conn = new mysqli($servername, $username, $password, $database);
include 'dataconn.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Movie data array
$movies = [
    [278, "The Shawshank Redemption", "Drama", 13.00, "https://www.themoviedb.org/movie/278"],
    [238, "The Godfather", "Crime, Drama", 13.00, "https://www.themoviedb.org/movie/238"],
    [155, "The Dark Knight", "Action, Crime, Drama", 13.00, "https://www.themoviedb.org/movie/155"],
    [240, "The Godfather Part II", "Crime, Drama", 13.00, "https://www.themoviedb.org/movie/240"],
    [389, "12 Angry Men", "Drama", 13.00, "https://www.themoviedb.org/movie/389"],
    [424, "Schindler's List", "Drama, History", 13.00, "https://www.themoviedb.org/movie/424"],
    [122, "The Lord of the Rings: The Return of the King", "Action, Adventure, Drama", 13.00, "https://www.themoviedb.org/movie/122"],
    [680, "Pulp Fiction", "Crime, Drama", 13.00, "https://www.themoviedb.org/movie/680"],
    [429, "The Good, the Bad and the Ugly", "Western", 13.00, "https://www.themoviedb.org/movie/429"],
    [550, "Fight Club", "Drama", 13.00, "https://www.themoviedb.org/movie/550"],
    [13, "Forrest Gump", "Comedy, Drama, Romance", 13.00, "https://www.themoviedb.org/movie/13"],
    [27205, "Inception", "Action, Adventure, Sci-Fi", 13.00, "https://www.themoviedb.org/movie/27205"],
    [120, "The Lord of the Rings: The Fellowship of the Ring", "Action, Adventure, Drama", 13.00, "https://www.themoviedb.org/movie/120"],
    [1891, "Star Wars: Episode V - The Empire Strikes Back", "Action, Adventure, Fantasy", 13.00, "https://www.themoviedb.org/movie/1891"],
    [121, "The Lord of the Rings: The Two Towers", "Action, Adventure, Drama", 13.00, "https://www.themoviedb.org/movie/121"],
    [603, "The Matrix", "Action, Sci-Fi", 13.00, "https://www.themoviedb.org/movie/603"],
    [769, "Goodfellas", "Crime, Drama", 13.00, "https://www.themoviedb.org/movie/769"],
    [510, "One Flew Over the Cuckoo's Nest", "Drama", 13.00, "https://www.themoviedb.org/movie/510"],
    [346, "Seven Samurai", "Action, Drama", 13.00, "https://www.themoviedb.org/movie/346"],
    [807, "Se7en", "Crime, Drama, Mystery", 13.00, "https://www.themoviedb.org/movie/807"]
];

// Insert movies into the database
foreach ($movies as $movie) {
    $stmt = $conn->prepare("INSERT INTO movies (movieid, title, genre, ticket_price, coverURL) VALUES (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE title=?, genre=?, ticket_price=?, coverURL=?");
    $stmt->bind_param("issdssdsd", $movie[0], $movie[1], $movie[2], $movie[3], $movie[4], $movie[1], $movie[2], $movie[3], $movie[4]);
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
<div class="product-container">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='movie'>";
            echo "<img src='" . $row['coverURL'] . "' alt='" . htmlspecialchars($row['title']) . "'>";
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
