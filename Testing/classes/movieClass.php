<?php

class movieClass {
    private $movieid;
    private $title;
    private $genre;
    private $ticket_price;


    public function __construct($movieid, $title, $genre, $ticket_price) {
        $this->movieid = $movieid;
        $this->title = $title;
        $this->genre = $genre;
        $this->ticket_price = $ticket_price;
    }

    public function getMovieId() {
        return $this->movieid;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getTicketPrice() {
        return $this->ticket_price;
    }
    public static function fetchAllMovies( $connection) {
        $movies = [];
        $query = "SELECT * FROM movies";


        $stmt =  $connection->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $movie = new movieClass(
                    $row['movieid'],
                    $row['title'],
                    $row['genre'],
                    $row['ticket_price'],
                );
                $movies[] = $movie;
            }
        }

        return $movies;
    }
}
?>
