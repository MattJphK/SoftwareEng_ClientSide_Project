<?php
require "../data/common.php";
if (isset($_POST['submit'])) {
    try {
        require_once '../src/DBconnect.php';
        $movie =[
            "movieid" => escape($_POST['movieid']),
            "title" => escape($_POST['title']),
            "genre" => escape($_POST['genre']),
            "ticket_price" => escape($_POST['ticket_price']),
        ];
        $sql = "UPDATE movies
 SET title = :title,
 genre = :genre,
 ticket_price = :ticket_price
 WHERE movieid = :movieid";
        $statement = $connection->prepare($sql);
        $statement->execute($movie);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
if (isset($_GET['movieid'])) {
    try {
        require_once '../src/DBconnect.php';
        $movieid = $_GET['movieid'];
        $sql = "SELECT * FROM movies WHERE movieid = :movieid";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':movieid', $movieid);
        $statement->execute();
        $movie = $statement->fetch(PDO::FETCH_ASSOC);
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
    <?php echo escape($_POST['title']); ?> successfully updated.
<?php endif; ?>
    <h2>Edit a movie</h2>
    <form method="post">
        <?php foreach ($movie as $key => $value) : ?>
            <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
            <input type="text" name="<?php echo $key; ?>" movieid="<?php echo $key;
            ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'movieid' ?
                'readonly' : null); ?>>
        <?php endforeach; ?>
        <input type="submit" name="submit" value="Submit">
    </form>
    <a href="update.php">Back to update</a>
<?php require "template/footer.php"; ?><?php
