<?php
include "Classes/ContentModerator.php";


$filtered = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $moderator = new ContentModeration();
    $inputText = $_POST['usertext'];
    $filtered = $moderator->filterWords($inputText);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Content Moderation Test</title>
</head>
<body>
<h1>Test Content Moderation</h1>
<form method="post">
    <label>Enter text:</label><br>
    <textarea name="usertext" rows="5" cols="40"></textarea><br><br>
    <input type="submit" value="Filter">
</form>

<?php if ($filtered != "") { ?>
    <h2>Filtered Output:</h2>
    <p><?php echo htmlspecialchars($filtered); ?></p>
<?php } ?>
</body>
</html>