<?php
// Movie.php
 require "../src/DBconnect.php";
class movieClass {
    private $movieid;
    private $title;
    private $genre;
    private $ticket_price;


    // Constructor to initialize the movie properties
    public function __construct($movieid, $title, $genre, $ticket_price) {
        $this->movieid = $movieid;
        $this->title = $title;
        $this->genre = $genre;
        $this->ticket_price = $ticket_price;
    }

    // Getters for the movie properties
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
    // Static method to fetch movies from the database
    public static function fetchAllMovies( $connection) {
        $movies = [];
        $query = "SELECT * FROM movies";  // Simple query to fetch all movies

        // Prepare the query using PDO

        $stmt =  $connection->prepare($query);
        $stmt->execute();  // Execute the query

        // Check if any movies were found
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Create new Movie object for each row
                $movie = new Movie(
                    $row['movieid'],
                    $row['title'],
                    $row['genre'],
                    $row['ticket_price'],
                );
                $movies[] = $movie;  // Add the movie to the array
            }
        }

        return $movies;
    }
}
?>
