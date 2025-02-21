<?php
$pgHeader = "Movie Descriptions";
$movieTitle1 = "Reservoir Dogs";
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
    <div class="top">
        <div class="logo">
            <a href="index.php" id="leftSitting"><img class="logo_img" src="images/logo.png" alt="logo" ></a>
        </div>
        <ul>
</head>
<header>
    <div class="nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="ProductDesc.php">Products</a></li>
            <li><a href="">Contact</a></li>
        </ul>
    </div>
</header>
<body>

<img src="images/movieCovers/rDogsImg.jpg" alt="Reservoir Dogs" width="300" height="300">
<p><?php echo $desc1; ?> </p>
</body>
</html>