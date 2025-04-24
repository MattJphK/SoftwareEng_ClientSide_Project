<?php

try {
    require_once "../data/common.php";
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
<h2>Update bookings</h2>
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
    <?php foreach ($result as $row) : ?>
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
            <td><a href="update-single4.php?bookingid=<?php echo escape($row["bookingid"]);
                ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

    <a href="update.php">return</a>
<a href="admin.php">Back to admin</a>
<?php require "template/footer.php"; ?>