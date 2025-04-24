<?php

try {
    require_once "../data/common.php";
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
<h2>Update users</h2>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Username</th>
        <th>Email</th>
        <th>Password</th>
        <th>Age</th>
        <th>Edit</th>
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
            <td><a href="update-single.php?userid=<?php echo escape($row["userid"]);
                ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="admin.php">Back to admin</a>
<!--Movies-->
<?php

try {
    require_once "../data/common.php";
    require_once '../src/DBconnect.php';
    $sql2 = "SELECT * FROM movies";
    $statement2 = $connection->prepare($sql2);
    $statement2->execute();
    $result2 = $statement2->fetchAll();
} catch(PDOException $error) {
    echo $sql2 . "<br>" . $error->getMessage();
}
?>
<h2>Update movies</h2>
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
            <td><a href="update-single2.php?movieid=<?php echo escape($row["movieid"]);
                ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="admin.php">Back to admin</a>
<!--review-->
<?php

try {
    require_once "../data/common.php";
    require_once '../src/DBconnect.php';
    $sql3 = "SELECT * FROM review";
    $statement3 = $connection->prepare($sql3);
    $statement3->execute();
    $result3 = $statement3->fetchAll();
} catch(PDOException $error) {
    echo $sql3 . "<br>" . $error->getMessage();
}
?>
<h2>Update reviews</h2>
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
            <td><a href="update-single3.php?reviewid=<?php echo escape($row["reviewid"]);
                ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="update2.php">Load More</a>
<a href="admin.php">Back to admin</a>



<?php require "template/footer.php"; ?>
