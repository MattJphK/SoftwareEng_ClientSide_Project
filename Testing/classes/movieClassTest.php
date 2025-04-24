<?php
include "../src/DBconnect.php";
include "movieClass.php";

class movieClassTest {

public function main () {
    $movie = new movieClass(99,"Rocky","Action","2.00");
    $movie->getMovieId();
    $movie->getTitle();
    $movie->getGenre();
    $movie->getTicketPrice();
    $movie->getCoverImage();

    echo $movie->getMovieId();
    echo $movie->getTitle();
    echo $movie->getGenre();
    echo $movie->getTicketPrice();
    echo $movie->getCoverImage();



}





}
