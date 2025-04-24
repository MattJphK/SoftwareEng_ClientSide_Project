
<?php require "../Project Source/public/template/header.php"; ?>

<h1>Movie Test: FetchAll Method</h1>
<?php
require_once "./classes/movieClass.php";
require_once "./src/DBconnect.php";

$movies = movieClass::fetchAllMovies($connection);

if(empty($movies)){
    echo "<p>Failed to find Movies</p>";
}
else{
    foreach($movies as $movie){
        echo "<p>".$movie->getMovieId()."</p>";
        echo "<p>".$movie->getTitle()."</p>";
        echo "<p>".$movie->getGenre()."</p>";
        echo "<p>".$movie->getTicketPrice()."</p>";
    }
}

?>
<?php require "../Project Source/public/template/footer.php";

