<?php include "userTest.php";

$newUser = new userTest("matthew@gmail.com", "123"); //user the input is compared to

$message = '';

//Make sure the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs
    $inputEmail = $_POST['email'];
    $inputPassword = $_POST['password'];

    //Check login
    if ($newUser->matchDetails($inputEmail, $inputPassword)) {
        $message = "Login Successful";
    } else {
        $message = "Invalid email or password.";
    }
}

?>

<?php include "templates/header.php"; ?>

<link rel='stylesheet' type='text/css' href='css/formCSS.css' />
<div class="product-container">
    <div class="movie"
    <h3>Login</h3>
    <form method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required><br>
        <label for="password">Password</label>
        <input type="text" name="password" id="password"><br>
        <input type="submit" value="Login">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo $message;
    } ?>


    <a></a>
</div>
