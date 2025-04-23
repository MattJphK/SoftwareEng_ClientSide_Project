<?php
require "../data/common.php";;
$success = "";
if (isset($_GET["bookingid"])) {
    try {
        require_once '../src/DBconnect.php';
        $bookingid = $_GET["bookingid"];
        $sql = "DELETE FROM booking WHERE bookingid = :bookingid";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':bookingid', $bookingid);
        $statement->execute();
        $success = "Booking ". $bookingid. " successfully deleted";
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
try {
    require_once '../src/DBconnect.php';
    $sql = "SELECT * FROM booking";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "template/header.php"; ?>
<?php require "template/adminNav.php"; ?>
<h2>Delete bookings</h2>
<?php if ($success) echo $success; ?>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Date</th>
        <th>Seating</th>
        <th>Card Name</th>
        <th>Card Number</th>
        <th>Eir Code</th>
        <th>CVC</th>
        <th>Movie ID</th>
        <th>User ID</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo escape($row["bookingid"]); ?></td>
            <td><?php echo escape($row["date"]); ?></td>
            <td><?php echo escape($row["cardName"]); ?></td>
            <td><?php echo escape($row["cardNo"]); ?></td>
            <td><?php echo escape($row["eirCode"]); ?></td>
            <td><?php echo escape($row["cvc"]); ?></td>
            <td><?php echo escape($row["movieid"]); ?></td>
            <td><?php echo escape($row["userid"]); ?></td>
            <td><a href="delete2.php?bookingid=<?php echo escape($row["bookingid"]);
                ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="delete.php">Return</a>
<a href="admin.php">Back to home</a>