<?php
global $connection;
include '../data/install.php';
include '../data/config.php';
include '../data/common.php';
include '../src/DBconnect.php';
include '../classes/movieClass.php';
include '../classes/MovieCover.php';

$movies = MovieCover::fetchAllMoviesWithCover($connection);
?>

<?php include "template/header.php" ?>
<?php include "template/navbar.php" ?>
<div class="user">
<?php
if(isset($_SESSION['Username'])){
    ?>
    <form action="logout.php" method="post" name="logout_form" class="form_logout">
    <h1>Welcome: <?php echo $_SESSION['Username']?></h1>
    <button name="Submit" value="Logout" class="button"
            type="submit">Logout</button>
    </form>
    <?php
}
else {
    ?>
    <form action="login.php" method="post" name="login_form" class="form_login">
    <h1>Welcome: Guest</h1>
        <button name="Submit" value="Login" class="button"
                type="submit">Login</button>
    <?php
}
?>
</div>
    <div class="product-container">

        <?php
        if (count($movies) > 0) {
            foreach ($movies as $movie) {
                echo "<div class='movie'>";
                echo "<a href='Movie.php?id=" . $movie->getMovieId() . "'>";
                echo "<img src='covers/" . $movie->getCoverImage() . "' alt='" . htmlspecialchars($movie->getTitle()) . "'>"; //encapsulation
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
