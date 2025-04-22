<?php
require "../data/common.php";
require_once "../classes/movieClass.php";
require_once "../classes/MovieCover.php";

if(isset($_GET["id"])){
    $chosenMovie = $_GET['id'];
}
else{
    die("movie Not provided movie ID");
}

$movie = MovieCover::fetchCoverByMovieId($connection, $chosenMovie);
echo "Chosen Movie ID: " . htmlspecialchars($chosenMovie) . "<br>";
if(!$movie){
    echo "Movie not found for ID: " . htmlspecialchars($chosenMovie);
    die();
}
if(isset($_POST["submit"])){
    try {
        require_once '../src/DBconnect.php';
        $new_booking = array(
            "cardName" => escape($_POST['cardName']),
            "cardNo" => escape($_POST['cardNo']),
            "eirCode" => escape($_POST['eirCode']),
            "cvc" => escape($_POST['cvc']),
            "seating" => escape($_POST['seating']),
            "userid" => 1,
            "movieid" => escape($_POST['movieid']),
            "date" => date('Y-m-d')
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            "booking",
            implode(", ", array_keys($new_booking)),
            ":" . implode(", :", array_keys($new_booking))
        );
        $statement = $connection->prepare($sql);
        $result = $statement->execute($new_booking);

        if ($result) {
            $bookingId = $connection->lastInsertId();
            header("Location: bookingSuccess.php?id=" . $bookingId);
            exit();
        }
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
        $result = false;
    }
}
?>

<?php include "template/header.php" ?>
<?php include "template/navbar.php" ?>
<div class="product-container">
    <div class="movie">
        <h2>Your Booking A Ticket for <?php echo htmlspecialchars($movie->getTitle()); ?></h2>
        <form method="post">
            <h3>Card Details: </h3>
            <input type="hidden" name="movieid" value="<?php echo htmlspecialchars($chosenMovie)?>">
            <label for="cardName">Name On Card</label><br>
            <input type="text" id="cardName" name="cardName" value="Matthew Keenan"><br>
            <label for="cardNo">Card Number</label><br>
            <input type="text" id="cardNo" name="cardNo" value="0000 0000 000 0000"><br>
            <label for="eirCode">Eir Code</label><br>
            <input type="text" id="eirCode" name="eirCode" value="DX XXXX"><br>
            <label for="cvc">CVC</label><br>
            <input type="text" id="cvc" name="cvc" value="000"><br>
            <h3>Seat Selection:</h3>
            <label for="seating">Choose a Seat:</label><br>
            <select name="seating" id="seating">
            <option value="A1">A1</option>
            <option value="A2">A2</option>
            <option value="A3">A3</option>
            <option value="B1">B1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            </select><br><br><br>
            <button type="button" onclick="window.location.href='index.php'">Cancel</button>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>