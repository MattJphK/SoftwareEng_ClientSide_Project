<div class="top">
    <div class="logo">
        <a href="../index.php" id="leftSitting"><img class="logo_img" src=../images/logo.png alt="logo" ></a>
    </div>
    <ul>

        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <li> <form class="search-form" action="index.php" method="GET">
                <?php
                $searchInput = '';
                if (isset($_GET['search'])) {
                    $searchInput = htmlspecialchars($_GET['search']);
                }
                ?>
                <input type="text" name="search" placeholder="Search..." class="search-input" value="<?php echo $searchInput; ?>">
                <button type="submit" class="search-btn"><img src="../images/loupe.png"></button>
            </form>
        </li>
    </ul>
</div>
<div class="nav">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="ubitets.php">Unit Test</a></li>
        <li><a href="movieClassTest.php">Movie Test</a></li>
    </ul>
</div>
