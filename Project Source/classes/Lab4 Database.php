<?php
global $conn;
$pgHeader = "Movie Descriptions";
$movieTitle1 = "Movie Title 1";
$desc1 = "One of Quentin Tarantino Best Films about a heist gone wrong. Creates a tense atmosphere
                and enjoyable violance?" . "One of Quentin Tarantino Best Films about a heist gone wrong. Creates a tense atmosphere
                and enjoyable violance?" . "One of Quentin Tarantino Best Films about a heist gone wrong. Creates a tense atmosphere
                and enjoyable violance?" . "One of Quentin Tarantino Best Films about a heist gone wrong. Creates a tense atmosphere
                and enjoyable violance?";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movie Descriptions</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/Index.css">
    <link rel="stylesheet" href="css/Nav.css">
</head>
<header>

</header>
<body>
<div class="top">
    <div class="logo">
        <a href="index.php" id="leftSitting"><img class="logo_img" src="images/logo.png" alt="logo" ></a>
    </div>
    <ul>

        <li><a href="index.php">Login</a></li>
        <li><a href="index.php">Register</a></li>
        <li> <form class="search-form">
                <input type="text" placeholder="Search..." class="search-input">
                <button type="submit" class="search-btn"><img src="images/icons/loupe.png"></button>
            </form>
        </li>
    </ul>
</div>
<div class="nav">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="ProductDesc.php">Products</a></li>
        <li><a href="../public/Review.php">Reviews</a></li>
        <li><a href="Booking.php">Booking</a></li>
        <li><a href="">Contact</a></li>
    </ul>
</div>
<div class="product-container">
    <div class="movie">
    <?php
    include 'dataconn.php';

    $sql = "INSERT into booking Values (412,'24.02.25',09)";
    $sql2 = "select * from booking";

    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);

    if($result){
        echo "Booking Successful";
        echo $sql;
        echo "<br>";
        }
    else{
        echo "Error: ".mysqli_error($conn);
    }
    if($result2){
        echo $sql2;
        echo "<br>";
    }
    else{
        echo "Error: ".mysqli_error($conn);
    }?>
    </div>