<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['username']) && !empty($_POST['message'])) {
    $username = htmlspecialchars($_POST['username']);
    $message = htmlspecialchars($_POST['message']);
    $time = date("H:i");

    $entry = "[$time] <b>$username:</b> $message\n";

    file_put_contents("messages.txt", $entry, FILE_APPEND);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Messenger</title>
    <link rel="stylesheet" href="./css/chat.css">
</head>
<body>
<div class="chat-container">
    <h2>Simple Messenger</h2>

    <div class="chat-box">
        <?php
        if (file_exists("messages.txt")) {
            echo nl2br(file_get_contents("messages.txt"));
        }
        ?>
    </div>

    <form method="POST" class="chat-form">
        <input type="text" name="username" placeholder="Your name" required>
        <input type="text" name="message" placeholder="Type a message..." required>
        <button type="submit">Send</button>

        <div style="text-align: center; margin-top: 1em;">
            <a href="home.php" class="back-button">&larr; Back to Home</a>
        </div>
        
    </form>
</div>
</body>
</html>