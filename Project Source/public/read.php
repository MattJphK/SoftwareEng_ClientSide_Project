<?php
require "../data/common.php";
require_once '../src/DBconnect.php';#
$result = [];
$username = "";
if (isset($_POST['submit']) && isset($_POST['username'])) {
    try {
        $sql = "SELECT * FROM users WHERE username = :username";
        $username = $_POST['username'];
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
require "template/header.php";
require "template/adminNav.php";
if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) {
        ?>
        <h2>Results</h2>
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Age</th>
                <th>Admin</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo escape($row["userid"]); ?></td>
                    <td><?php echo escape($row["username"]); ?></td>
                    <td><?php echo escape($row["email"]); ?></td>
                    <td><?php echo escape($row["pass"]); ?></td>
                    <td><?php echo escape($row["isAdmin"]); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        > No Users found for <?php echo escape($_POST['username']); ?>.
    <?php }
} ?>
    <h2>Find user based on username</h2>
    <form method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username">
        <input type="submit" name="submit" value="View Results">
    </form>
    <a href="admin.php">Back to home</a>

<!--Booking-->
<?php
$result2 = [];
$cardName = "";
    if (isset($_POST['booking_submit']) && isset($_POST['cardName'])) {
    try {
    $sql2 = "SELECT * FROM booking WHERE cardName = :cardName";
    $cardName = $_POST['cardName'];
    $statement2 = $connection->prepare($sql2);
    $statement2->bindParam(':cardName', $cardName, PDO::PARAM_STR);
    $statement2->execute();
    $result2 = $statement2->fetchAll();
    } catch(PDOException $error) {
    echo $sql2 . "<br>" . $error->getMessage();
    }
    }
    if (isset($_POST['booking_submit'])) {
    if ($result2 && $statement2->rowCount() > 0) {
    ?>
    <h2>Results</h2>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Movie ID</th>
            <th>User ID</th>
            <th>Date</th>
            <th>Seating</th>
            <th>Card Name</th>
            <th>Card Number</th>
            <th>Eir Code</th>
            <th>CVC</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result2 as $row) { ?>
            <tr>
                <td><?php echo escape($row["bookingid"]); ?></td>
                <td><?php echo escape($row["movieid"]); ?></td>
                <td><?php echo escape($row["userid"]); ?></td>
                <td><?php echo escape($row["date"]); ?></td>
                <td><?php echo escape($row["seating"]); ?></td>
                <td><?php echo escape($row["cardName"]); ?></td>
                <td><?php echo escape($row["cardNo"]); ?></td>
                <td><?php echo escape($row["eirCode"]); ?></td>
                <td><?php echo escape($row["cvc"]); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    > No Bookings found for <?php echo escape($_POST['cardName']); ?>.
<?php }
} ?>
    <h2>Find booking based on card name</h2>
    <form method="post">
        <label for="cardName">Card Name</label>
        <input type="text" id="cardName" name="cardName" placeholder="Card Name">
        <input type="submit" name="booking_submit" value="View Results">
    </form>
    <a href="admin.php">Back to home</a>

<!--Movies-->
<?php
$result3 = [];
$genre = "";
if (isset($_POST['movie_submit']) && isset($_POST['genre'])) {
    try {
        $sql3 = "SELECT * FROM movies WHERE genre = :genre";
        $genre = $_POST['genre'];
        $statement3 = $connection->prepare($sql3);
        $statement3->bindParam(':genre', $genre, PDO::PARAM_STR);
        $statement3->execute();
        $result3 = $statement3->fetchAll();
    } catch(PDOException $error) {
        echo $sql3 . "<br>" . $error->getMessage();
    }
}
if (isset($_POST['movie_submit'])) {
    if ($result3 && $statement3->rowCount() > 0) {
        ?>
        <h2>Results</h2>
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Ticket Price</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($result3 as $row) { ?>
                <tr>
                    <td><?php echo escape($row["movieid"]); ?></td>
                    <td><?php echo escape($row["title"]); ?></td>
                    <td><?php echo escape($row["genre"]); ?></td>
                    <td><?php echo escape($row["ticket_price"]); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        > No Movies found for <?php echo escape($_POST['genre']); ?>.
    <?php }
} ?>
    <h2>Find movies based on genre</h2>
    <form method="post">
        <label for="genre">Genre</label>
        <input type="text" id="genre" name="genre" placeholder="Genre">
        <input type="submit" name="movie_submit" value="View Results">
    </form>
    <a href="read2.php">Load More</a>
    <a href="admin.php">Back to home</a>
<?php require "template/footer.php"; ?>