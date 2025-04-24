
<?php require "../Project Source/public/template/header.php"; ?>

<h1>User Test: Username Getters/Setters</h1>
<?php
require_once "./classes/User.php";

$usernames = ["Matthew","Stan","Fabio","Nathan","Laura"];

foreach($usernames as $username){
    $user = new User();
    $user->setUsername($username);

    if($user->getUsername() == $username){
        echo "<p>Username: ".$user->getUsername()."</p><br>";
    }
    else{
        echo "<p>Username Test Unsuccessful: </p>";
    }


}

?>
<?php require "../Project Source/public/template/footer.php";

