<?php
if (isset($_POST['submit'])) {
    require "../data/common.php";
    try {
        require_once '../src/DBconnect.php';
        $new_user = array(
            "username" => escape($_POST['username']),
            "password" => escape($_POST['password']),
            "email" => escape($_POST['email']),
            "age" => escape($_POST['age'])
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            "users",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_POST['submit']) && $statement) {
    echo $new_user['username'] . ' successfully added';
}
?>
<?php include "template/header.php" ?>
<h2>Add a user</h2>
<form method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <label for="age">Age</label>
    <input type="number" name="age" id="age"><br><br>
    <input type="submit" name="submit" value="Submit">
    <a href="index.php">Back to home</a>
</form>

