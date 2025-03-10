<?php
$servername = 'localhost';
$username = 'root';
<<<<<<< HEAD
$password = 'root';
=======
$password = 'Ilovetea24!';
>>>>>>> 90e2ecf11a418ebccd99a24e754c78fbe3cff4ac
$dbname = 'thedirectorsdb';

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
    echo "Connected successfully";
}

?>