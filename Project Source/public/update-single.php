<?php
/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */
require "../data/common.php";
if (isset($_POST['submit'])) {
    try {
        require_once '../src/DBconnect.php';
        $user =[
            "userid" => escape($_POST['userid']),
            "username" => escape($_POST['username']),
            "email" => escape($_POST['email']),
            "pass" => escape($_POST['pass']),
            "age" => escape($_POST['age']),
        ];
        $sql = "UPDATE users
 SET username = :username,
 email = :email,
 pass = :pass,
 age = :age
 WHERE userid = :userid";
        $statement = $connection->prepare($sql);
        $statement->execute($user);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
if (isset($_GET['userid'])) {
    try {
        require_once '../src/DBconnect.php';
        $userid = $_GET['userid'];
        $sql = "SELECT * FROM users WHERE userid = :userid";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':userid', $userid);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
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
    <?php echo escape($_POST['username']); ?> successfully updated.
<?php endif; ?>
    <h2>Edit a user</h2>
    <form method="post">
        <?php foreach ($user as $key => $value) : ?>
            <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
            <input type="text" name="<?php echo $key; ?>" userid="<?php echo $key;
            ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'userid' ?
                'readonly' : null); ?>>
        <?php endforeach; ?>
        <input type="submit" name="submit" value="Submit">
    </form>
    <a href="update.php">Back to update</a>
<?php require "template/footer.php"; ?>