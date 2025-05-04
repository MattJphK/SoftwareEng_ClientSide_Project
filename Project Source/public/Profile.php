<?php
global $connection;
include "template/header.php";
include "template/navbar.php";
include '../src/DBconnect.php';
include '../data/config.php';
include '../data/common.php';

if (isset($_SESSION['Username'])) {
    $result = [];
    $username = $_SESSION['Username'];

    try {
        $sql = "SELECT userscore FROM users WHERE username = :username";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    if ($result && !empty($result['userscore'])) {
        $userscore = $result['userscore'];
    } else {
        $userscore = 'N/A';
    }
    ?>

    <div class="profileDisplay">
        <img src="images/user.png" alt="Profile Picture">
        <div>
            <h3 class="profile-text">User: <?php echo escape($username); ?></h3>
            <p class="profile-text">Review Score: <?php echo escape($userscore); ?></p>
        </div>
    </div>
    <div class="profileOptions">
        <ul class>
            <li class="text-style"><a href="../Profile.php?view=purchaseHistory" class="text-style">Purchase History</a>
            </li>
        </ul>
    </div>
    <?php
}


if (isset($_GET['view'])) {
    $view = $_GET['view'];

    if ($view === 'purchaseHistory') {

        if (isset($_SESSION['Username']) && isset($_SESSION['userid'])) {
            $userid = $_SESSION['userid'];

            try {
                $sql = "
                SELECT booking.date, booking.seating, booking.cardName, movies.title, movies.ticket_price
                FROM booking
                JOIN movies ON booking.movieid = movies.movieid
                WHERE booking.userid = :userid
                ORDER BY booking.date DESC
            ";

                $stmt = $connection->prepare($sql);
                $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
                $stmt->execute();
                $bookings = $stmt->fetchAll();

                if ($bookings && count($bookings) > 0) {
                    echo "<div class='profile-purchasehistory'>";
                    echo "<h2>Purchase History</h2>";
                    echo "<table class='purchase-history'>";
                    echo "<thead>
                        <tr>
                            <th>Date</th>
                            <th>Movie</th>
                            <th>Seat</th>
                            <th>Name on Card</th>
                            <th>Ticket Price (€)</th>
                        </tr>
                      </thead>";
                    echo "<tbody>";

                    foreach ($bookings as $booking) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($booking['date']) . "</td>";
                        echo "<td>" . htmlspecialchars($booking['title']) . "</td>";
                        echo "<td>" . htmlspecialchars($booking['seating']) . "</td>";
                        echo "<td>" . htmlspecialchars($booking['cardName']) . "</td>";
                        echo "<td>" . $booking['ticket_price']. "</td>";
                        echo "</tr>";
                    }

                    echo "</tbody></table>";
                    echo "</div>";
                } else {
                    echo "<div class='profile-purchasehistory'>";
                    echo "<p>No purchases found.</p>";
                    echo "</div>";

                }
            } catch (PDOException $e) {
                echo "<div class='profile-purchasehistory'>";

                echo "<p>Error retrieving purchase history: " . $e->getMessage() . "</p>";
                echo "</div>";

            }
        } else {
            echo "<div class='profile-purchasehistory'>";

            echo "<p>Please log in to view your purchase history.</p>";
            echo "</div>";

        }

    }
}


require "template/footer.php";
?>