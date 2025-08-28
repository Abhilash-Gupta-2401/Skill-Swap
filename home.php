<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/home.css">
</head>
<body>
    <!-- navbar -->
        <nav class="navbar">
            <div class="logo">
                <a href="#">Welcome,<?php echo htmlspecialchars($_SESSION['user']); ?>!</a>
            </div>
            <ul class="nav-links">
                <!-- <li><a href="./home.php">Home</a></li> -->
                 <li><a href="./about.html">About </a></li>
                <li><a href="./post_skill.php">Post-Skill</a></li>
                <li><a href="./browse_skill.php">Browse-Skill</a></li>
                <li><a href="./chat.php">Chat</a></li>
                <li><a href="./logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="content">
            <h1>"A Place Where Talents Meet"</h1>
            <p>Whether you're a coder, cook, designer, or dancer — swap your skills and gain something new every day.</p>
        </div>

    
</body>
</html>