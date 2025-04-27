<?php
session_start();
if ($_SESSION['Active'] == false) {
    header("location:login.php");
    exit;
}


require "../data/common.php";
require_once "../classes/movieClass.php";
require_once "../classes/MovieCover.php";

if (isset($_GET["id"])) {
    $chosenMovie = $_GET['id'];
} else {
    die("movie Not provided movie ID");
}

$movie = MovieCover::fetchCoverByMovieId($connection, $chosenMovie);
echo "Chosen Movie ID: " . htmlspecialchars($chosenMovie) . "<br>";

if (!$movie) {
    echo "Movie not found for ID: " . htmlspecialchars($chosenMovie);
    die();
}

if (isset($_POST["submit"])) {
    try {
        require_once '../src/DBconnect.php';
        $userId = $_SESSION['userid'];
        $new_booking = array(
            "cardName" => escape($_POST['cardName']),
            "cardNo" => escape($_POST['cardNo']),
            "eirCode" => escape($_POST['eirCode']),
            "cvc" => escape($_POST['cvc']),
            "seating" => escape($_POST['seating']),
            "userid" =>  $userId,
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
            $bookingQuery = "SELECT bookingid FROM booking WHERE userid = :userid AND movieid = :movieid AND date = :date ORDER BY bookingid DESC LIMIT 1";
            $queryStatement = $connection->prepare($bookingQuery);
            $queryStatement->execute(["userid" => $new_booking["userid"], "movieid" => $new_booking["movieid"], "date" => date('Y-m-d')]);
            $booking = $queryStatement->fetch(PDO::FETCH_ASSOC);
            if ($booking) {
                $bookingid = $booking["bookingid"];
                header("location: bookingSuccess.php?id=" . $bookingid);
                exit();
            }
            else{
                echo "No booking found";
            }
        }
    } catch (PDOException $error) {
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
        <p><strong>Ticket Price:</strong>€<?php echo number_format($movie->getTicketPrice(), 2); ?></p>
        <form method="post">
            <h3>Card Details: </h3>
            <input type="hidden" name="movieid" value="<?php echo htmlspecialchars($chosenMovie) ?>">
            <label for="cardName">Name On Card</label><br>
            <input type="text" id="cardName" name="cardName" placeholder="Matthew Keenan" required><br>
            <label for="cardNo">Card Number</label><br>
            <input type="text" id="cardNo" name="cardNo" placeholder="0000 0000 000 0000" required><br>
            <label for="eirCode">Eir Code</label><br>
            <input type="text" id="eirCode" name="eirCode" placeholder="DX XXXX" required><br>
            <label for="cvc">CVC</label><br>
            <input type="text" id="cvc" name="cvc" placeholder="000" required><br>
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