<?php
    $cardName = "";
    $cardNo = 0;
    $cvc = 0;

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
        <li><a href="Review.php">Reviews</a></li>
        <li><a href="Booking.php">Booking</a></li>
        <li><a href="">Contact</a></li>
    </ul>
</div>
<div class="product-container">
    <div class="movie">
        <form action="/action_page.php">
            <label for="cname">Name On Card</label><br>
            <input type="text" id="cname" name="cname" value="Matthew Keenan"><br>
            <label for="cardNo">Card Number</label><br>
            <input type="text" id="cardNo" name="cardNo" value="0000 0000 000 0000"><br>
            <label for="eir">Eir Code</label><br>
            <input type="text" id="eir" name="eir" value="DX XXXX"><br>
            <label for="cvc">CVC</label><br>
            <input type="text" id="cvc" name="cvc" value="000"><br><br>
            <button type="button" onclick="window.location.href='index.php'">Cancel</button>
            <input type="submit" value="Submit">
        </form>
    </div>