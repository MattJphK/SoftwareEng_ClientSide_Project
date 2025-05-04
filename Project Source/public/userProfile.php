<?php
global $connection;
include "template/header.php";
include "template/navbar.php";
include '../src/DBconnect.php';
include '../data/config.php';
include '../data/common.php';

if (isset($_GET['username'])) {
    $result = [];
    $username = $_GET['username'];


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_review'])) {
        $rating = $_POST['user_review'];
        if ($rating >= 1 && $rating <= 5) {
            try {
                $updateScore = $connection->prepare("UPDATE users SET userscore = userscore + :rating WHERE username = :username");
                $updateScore->execute([
                    ':rating' => $rating,
                    ':username' => $username
                ]);
                echo '<div class="profileDisplay">';
                echo "<p class='success'>Thanks for rating this user!</p>";
                echo '</div>';

            } catch (PDOException $e) {
                echo "<p>Error updating score: " . $e->getMessage() . "</p>";
            }
        }
    }

    try {
        $sql = "SELECT username, age, userscore FROM users WHERE username = :username";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch();
    } catch (PDOException $error) {
        echo "<p>Error: " . $error->getMessage() . "</p>";
    }

    if ($result) {
        ?>
        <div class="profileDisplay">
            <img src="images/user.png" alt="Profile Picture">
            <div>
                <h3 class="profile-text">User: <?php echo escape($result['username']); ?></h3>
                <p class="profile-text">Age: <?php echo escape($result['age']); ?></p>
                <p class="profile-text">Review Score: <?php echo escape($result['userscore']); ?></p>
            </div>
        </div>

        <!-- Review Form -->
        <div class="profileDisplay">

            <form method="POST" class="review-user-form">
                <label for="user_review">Rate this user (1–5):</label>
                <select name="user_review" id="user_review" required>
                    <option value="" disabled selected>Choose rating</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>

                </select>
                <button type="submit">Submit Rating</button>
            </form>
        </div>

        <?php
    } else {
        echo "<p>User not found.</p>";
    }
} else {
    echo "<p>No user specified.</p>";
}

require "template/footer.php";
?>
