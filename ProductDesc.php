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
    <title>Product Description</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/Index.css">
    <link rel="stylesheet" href="css/Nav.css">
    <h1><?php echo $pgHeader; ?></h1>
</head>
<header>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="ProductDesc.php">Products</a></li>
        <li><a href="">Contact</a></li>
    </ul>
</header>
<body>
<h2><?php echo $movieTitle1; ?> </h2>
<img src="images/movieCovers/rDogsImg.jpg" alt="Reservoir Dogs" width="300" height="300">
<p><?php echo $desc1; ?> </p>
</body>
</html>