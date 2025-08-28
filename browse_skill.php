<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse Skills</title>
    <link rel="stylesheet" href="css/browse_skill.css">
</head>
<body>
    <div class="profile-container">
    <?php
    $result = $conn->query("SELECT name, image, email, linkedin, github, skill_proficient, location FROM skills");
    while($row = $result->fetch_assoc()) {
        echo "<div class='profile-card'>";
        echo "<img class='profile-image' src='{$row['image']}' alt='Profile Image'>";
        echo "<div class='profile-info'>";
        echo "<strong>{$row['name']}</strong><br>";
        echo "Email: <a href='mailto:{$row['email']}'>{$row['email']}</a><br>";
        echo "LinkedIn: <a href='{$row['linkedin']}' target='_blank'>{$row['linkedin']}</a><br>";
        echo "Git-Hub: <a href='{$row['github']}' target='_blank'>{$row['github']}</a><br>";
        echo "Skill Offered: {$row['skill_proficient']}<br>";
        echo "Location: {$row['location']}";
        echo "</div></div>";
    }
    ?>
    </div>

    <div style="text-align: center; margin-top: 1em;">
        <form action="home.php" method="get">
            <button type="submit" class="back-button">&larr; Back to Home</button>
        </form>
    </div>

</body>
</html>
