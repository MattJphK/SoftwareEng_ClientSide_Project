<?php
require "../data/common.php";
if (isset($_POST['submit'])) {
    try {
        require_once '../src/DBconnect.php';
        $review =[
            "reviewid" => escape($_POST['reviewid']),
            "review_text" => escape($_POST['review_text']),
            "moviescore" => escape($_POST['moviescore']),
            "movieid" => escape($_POST['movieid']),
        ];
        $sql = "UPDATE review
 SET review_text = :review_text,
 moviescore = :moviescore,
 movieid = :movieid
 WHERE reviewid = :reviewid";
        $statement = $connection->prepare($sql);
        $statement->execute($review);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
if (isset($_GET['reviewid'])) {
    try {
        require_once '../src/DBconnect.php';
        $reviewid = $_GET['reviewid'];
        $sql = "SELECT * FROM review WHERE reviewid = :reviewid";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':reviewid', $reviewid);
        $statement->execute();
        $review = $statement->fetch(PDO::FETCH_ASSOC);
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
    <?php echo escape($_POST['reviewid']); ?> successfully updated.
<?php endif; ?>
    <h2>Edit a movie</h2>
    <form method="post">
        <?php foreach ($review as $key => $value) : ?>
            <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
            <input type="text" name="<?php echo $key; ?>" reviewid="<?php echo $key;
            ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'reviewid' ?
                'readonly' : null); ?>>
        <?php endforeach; ?>
        <input type="submit" name="submit" value="Submit">
    </form>
    <a href="update.php">Back to update</a>
<?php require "template/footer.php"; ?><?php
