<div class="top">
    <div class="logo">
        <a href="../index.php" id="leftSitting"><img class="logo_img" src=../images/logo.png alt="logo"></a>
    </div>
    <?php
    if (isset($_SESSION['Username'])){
        ?>
        <div class="top-right">
            <form action="../logout.php" method="post" name="logout_form" class="logout_form">
                <ul>
                    <li class="text-style"><a href="../Profile.php" class="text-style">Welcome: <?php echo $_SESSION['Username'] ?></a></li>
                    <li>
                        <button name="Submit" value="Logout" class="button" type="submit">Logout</button>
                    </li>
                </ul>
            </form>
        </div>
        <?php
    }
    else {
    ?>
    <ul>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>

        <?php
        }
        ?>
        <li>
            <form class="search-form" action="index.php" method="GET">
                <?php
                $searchInput = '';
                if (isset($_GET['search'])) {
                    $searchInput = htmlspecialchars($_GET['search']);
                }
                ?>
                <input type="text" name="search" placeholder="Search..." class="search-input"
                       value="<?php echo $searchInput; ?>">
                <button type="submit" class="search-btn"><img src="../images/loupe.png"></button>
            </form>
        </li>
    </ul>
</div>
<div class="nav">
    <ul>
        <li><a href="index.php">Home</a></li>
    </ul>
</div>
