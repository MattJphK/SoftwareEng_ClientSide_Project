<?php
include "../src/DBconnect.php";
require "../classes/movieClass.php";

class movieClassTest {

public static function main () {
    $movie = new movieClass(99,"Rocky","Action","2.00");

    echo $movie->getMovieId();
    echo $movie->getTitle();
    echo $movie->getGenre();
    echo $movie->getTicketPrice();
    echo $movie->getCoverImage();
    

return self::main();
}


}
