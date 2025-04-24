<?php
require "../data/common.php";
if (isset($_POST['submit'])) {
    try {
        require_once '../src/DBconnect.php';
        $booking =[
            "bookingid" => escape($_POST['bookingid']),
            "movieid" => escape($_POST['movieid']),
            "userid" => escape($_POST['userid']),
            "date" => escape($_POST['date']),
            "seating" => escape($_POST['seating']),
            "cardName" => escape($_POST['cardName']),
            "cardNo" => escape($_POST['cardNo']),
            "eirCode" => escape($_POST['eirCode']),
            "cvc" => escape($_POST['cvc']),
        ];
        $sql = "UPDATE booking
 SET movieid = :movieid,
 userid = :userid,
 date = :date,
 seating = :seating,
 cardName = :cardName,
 cardNo = :cardNo,
 eirCode = :eirCode,
 cvc = :cvc
 WHERE bookingid = :bookingid";
        $statement = $connection->prepare($sql);
        $statement->execute($booking);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
if (isset($_GET['bookingid'])) {
    try {
        require_once '../src/DBconnect.php';
        $bookingid = $_GET['bookingid'];
        $sql = "SELECT * FROM booking WHERE bookingid = :bookingid";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':bookingid', $bookingid);
        $statement->execute();
        $booking = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}
?>
<?php require "template/header.php"; ?>
<?php require "template/adminNav.php"; ?>
<?php if (isset($_POST['submit']) && $statement) : ?>
    <?php echo escape($_POST['cardName']); ?> successfully updated.
<?php endif; ?>
    <h2>Edit a booking</h2>
    <form method="post">
        <?php foreach ($booking as $key => $value) : ?>
            <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
            <input type="text" name="<?php echo $key; ?>" bookingid="<?php echo $key;
            ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'bookingid' ?
                'readonly' : null); ?>>
        <?php endforeach; ?>
        <input type="submit" name="submit" value="Submit">
    </form>
    <a href="update2.php">Back to update</a>
<?php require "template/footer.php"; ?>