<?php
$pgHeader = "Movie Descriptions";
$movieTitle1 = "Movie Title 1";
$desc1 = "One of Quentin Tarantino Best Films about a heist gone wrong. Creates a tense atmosphere
                and enjoyable violance?";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us</title>
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
        <li><a href="">Contact</a></li>
    </ul>
</div>
<div class="product-container">
    <div class="movie">
        <img src="images/movieCovers/rDogsImg.jpg" alt="Movie 1">
        <h3><?php echo $movieTitle1 ?></h3>
    </div>