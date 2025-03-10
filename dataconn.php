<?php
$servername = 'localhost';
$username = 'root';
$password = 'Ilovetea24!';
$dbname = 'thedirectorsdb';

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
    echo "Connected successfully";
}

?>