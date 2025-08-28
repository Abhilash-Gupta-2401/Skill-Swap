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
    <title>Post Skill</title>
    <link rel="stylesheet" href="./css/postskill.css">
</head>

<?php if (isset($_GET['error']) && $_GET['error'] == 'duplicate'): ?>
    <p style="color: red; text-align: center;">Email or Username already exists. Please use a different one.</p>
<?php endif; ?>

<body>
    <form class="post-skill-form" action="submit_skill.php" method="post" enctype="multipart/form-data">
        <h2>Post Your Skill</h2>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="image">Upload Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>

        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="linkedin">LinkedIn Profile:</label>
        <input type="text" name="linkedin" id="linkedin">

        <label for="github">GitHub Profile:</label>
        <input type="text" name="github" id="github">

        <label for="skill_proficient">Skill Proficient At:</label>
        <input type="text" name="skill_proficient" id="skill_proficient" required>

        <label for="skill_learn">Skill to Learn:</label>
        <input type="text" name="skill_learn" id="skill_learn" required>

        <input type="submit" value="Submit">
         
        <div style="text-align: center; margin-top: 1em;">
            <a href="home.php" class="back-button">&larr; Back to Home</a>
        </div>

    </form>

    
   
</body>
</html>