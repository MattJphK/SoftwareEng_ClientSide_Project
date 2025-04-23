<?php
require "../data/common.php";
require_once '../src/DBconnect.php';
$result = [];
$moviescore = "";
if (isset($_POST['submit']) && isset($_POST['moviescore'])) {
    try {
        $sql = "SELECT * FROM review WHERE moviescore = :moviescore";
        $moviescore = $_POST['moviescore'];
        $statement = $connection->prepare($sql);
        $statement->bindParam(':moviescore', $moviescore, PDO::PARAM_STR);
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
                <th>Text</th>
                <th>Score</th>
                <th>Movie ID</th>
                <th>User ID</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo escape($row["reviewid"]); ?></td>
                    <td><?php echo escape($row["review_text"]); ?></td>
                    <td><?php echo escape($row["moviescore"]); ?></td>
                    <td><?php echo escape($row["movieid"]); ?></td>
                    <td><?php echo escape($row["userid"]); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        > No Users found for <?php echo escape($_POST['moviescore']); ?>.
    <?php }
} ?>
<h2>Find user based on review</h2>
<form method="post">
    <label for="username">Movie Score</label>
    <input type="text" id="moviescore" name="moviescore" placeholder="1-10">
    <input type="submit" name="submit" value="View Results">
</form>
<a href="read.php">Back to Read 1</a>
<a href="admin.php">Back to home</a>