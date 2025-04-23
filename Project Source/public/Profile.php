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
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    $userscore = $result ? $result['userscore'] : 'N/A';
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
            <li class="text-style"><a href="../Profile.php?view=PurchaseHistory" class="text-style">Purchase History</a></li>
            <li class="text-style"><a href="../Profile.php?view=MyTickets" class="text-style">My Tickets</a></li>
        </ul>
    </div>
    <?php
}


if (isset($_GET['view'])) {
    $view = $_GET['section'];

    if ($view === 'history') {
        // Replace this with your real query and display logic
        echo "<h2>Purchase History</h2>";
        echo "<p>Show past purchases here...</p>";

    } elseif ($view === 'tickets') {
        // Replace this with your real ticket display logic
        echo "<h2>My Tickets</h2>";
        echo "<p>Show active or upcoming tickets here...</p>";
    }
}


require "template/footer.php";
?>