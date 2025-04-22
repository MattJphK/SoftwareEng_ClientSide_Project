<?php
require "../data/common.php";
require_once "../classes/movieClass.php";
require_once "../classes/MovieCover.php";
require_once '../src/DBconnect.php';
if (isset($_GET["id"])) {
    try {
        $bookingId = $_GET["id"];
        $sql = "SELECT * FROM booking WHERE bookingid = :bookingid";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':bookingid', $bookingId, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        $movietitle = "Unknown";
        $moviePrice = 0.00;
        if($result && count($result)>0) {
            $movieId = $result[0]["movieid"];
            $movie = MovieCover::fetchCoverByMovieId($connection, $movieId);
            $movieTitle = $movie->getTitle();
            $moviePrice = $movie->getTicketPrice();
        }
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
include "template/header.php";
include "template/navbar.php";

if (isset($_GET["id"])) {
    if ($result && $statement->rowCount() > 0) {
        ?>
<div class="product-container">
    <div class="movie">
        <h2>Your Booking</h2>
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Card Number</th>
                <th>Eir Code</th>
                <th>Seat</th>
                <th>Date</th>
                <th>Movie ID</th>
                <th>Movie Title</th>
                <th>Price</th>
                <th>User ID</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo escape($row["bookingid"]); ?></td>
                    <td><?php echo escape($row["cardName"]); ?></td>
                    <td><?php echo escape($row["cardNo"]); ?></td>
                    <td><?php echo escape($row["eirCode"]); ?></td>
                    <td><?php echo escape($row["seating"]); ?></td>
                    <td><?php echo escape($row["date"]); ?></td>
                    <td><?php echo escape($row["movieid"]); ?></td>
                    <td><?php echo htmlspecialchars($movieTitle); ?></td>
                    <td><?php echo number_format($moviePrice,2); ?></td>
                    <td><?php echo escape($row["userid"]); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <a href="index.php">Back to home</a>
    </div>
</div>

    <?php } else { ?>
        > No results found for <?php echo escape($_GET['id']); ?>.
    <?php }
} ?>

