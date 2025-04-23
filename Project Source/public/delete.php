<?php
/**
 * Delete a user
 */
require "../data/common.php";;
$success = "";
if (isset($_GET["userid"])) {
    try {
        require_once '../src/DBconnect.php';
        $userid = $_GET["userid"];
        $sql = "DELETE FROM users WHERE userid = :userid";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':userid', $userid);
        $statement->execute();
        $success = "User ". $userid. " successfully deleted";
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
try {
    require_once '../src/DBconnect.php';
    $sql = "SELECT * FROM users";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "template/header.php"; ?>
<?php require "template/adminNav.php"; ?>
<h2>Delete users</h2>
<?php if ($success) echo $success; ?>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Username</th>
        <th>Email</th>
        <th>Password</th>
        <th>Age</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo escape($row["userid"]); ?></td>
            <td><?php echo escape($row["username"]); ?></td>
            <td><?php echo escape($row["email"]); ?></td>
            <td><?php echo escape($row["pass"]); ?></td>
            <td><?php echo escape($row["age"]); ?></td>
            <td><a href="delete.php?userid=<?php echo escape($row["userid"]);
                ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="admin.php">Back to home</a>


<!--Movies-->
<?php
$success2 = "";
if (isset($_GET["movieid"])) {
    try {
        require_once '../src/DBconnect.php';
        $movieid = $_GET["movieid"];
        $sql2 = "DELETE FROM movies WHERE movieid = :movieid";
        $statement2 = $connection->prepare($sql2);
        $statement2->bindValue(':movieid', $movieid);
        $statement2->execute();
        $success2 = "Movie ". $movieid. " successfully deleted";
    } catch(PDOException $error) {
        echo $sql2 . "<br>" . $error->getMessage();
    }
}
try {
    require_once '../src/DBconnect.php';
    $sql2 = "SELECT * FROM movies";
    $statement2 = $connection->prepare($sql2);
    $statement2->execute();
    $result2 = $statement2->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>
<h2>Delete movies</h2>
<?php if ($success2) echo $success2; ?>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Genre</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result2 as $row) : ?>
        <tr>
            <td><?php echo escape($row["movieid"]); ?></td>
            <td><?php echo escape($row["title"]); ?></td>
            <td><?php echo escape($row["genre"]); ?></td>
            <td><?php echo escape($row["ticket_price"]); ?></td>
            <td><a href="delete.php?movieid=<?php echo escape($row["movieid"]);
                ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="admin.php">Back to home</a>
<!--review-->
<?php
$success3 = "";
if (isset($_GET["reviewid"])) {
    try {
        require_once '../src/DBconnect.php';
        $reviewid = $_GET["reviewid"];
        $sql3 = "DELETE FROM review WHERE reviewid = :reviewid";
        $statement3 = $connection->prepare($sql3);
        $statement3->bindValue(':reviewid', $reviewid);
        $statement3->execute();
        $success3 = "Review ". $reviewid. " successfully deleted";
    } catch(PDOException $error) {
        echo $sql3 . "<br>" . $error->getMessage();
    }
}
try {
    require_once '../src/DBconnect.php';
    $sql3 = "SELECT * FROM review";
    $statement3 = $connection->prepare($sql3);
    $statement3->execute();
    $result3 = $statement3->fetchAll();
} catch(PDOException $error) {
    echo $sql3 . "<br>" . $error->getMessage();
}
?>
<h2>Delete review</h2>
<?php if ($success3) echo $success3; ?>
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
    <?php foreach ($result3 as $row) : ?>
        <tr>
            <td><?php echo escape($row["reviewid"]); ?></td>
            <td><?php echo escape($row["review_text"]); ?></td>
            <td><?php echo escape($row["moviescore"]); ?></td>
            <td><?php echo escape($row["movieid"]); ?></td>
            <td><?php echo escape($row["userid"]); ?></td>
            <td><a href="delete.php?reviewid=<?php echo escape($row["reviewid"]);
                ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="delete2.php">Load More</a>
<a href="admin.php">Back to home</a>

<?php require "template/footer.php"; ?>

