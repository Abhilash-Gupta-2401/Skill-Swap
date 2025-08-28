<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $linkedin = $_POST['linkedin'];
    $github = $_POST['github'];
    $skill_proficient = $_POST['skill_proficient'];
    $skill_learn = $_POST['skill_learn'];

    // Check for duplicate email or username
    $check = $conn->prepare("SELECT id FROM skills WHERE email = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        // Duplicate found, redirect with error
        header("Location: post_skill.php?error=duplicate");
        exit();
    }

    // Handle image upload
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . time() . "_" . $image_name;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO skills (name, image, location, email, username, linkedin, github, skill_proficient, skill_to_learn)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $name, $target_file, $location, $email, $username, $linkedin, $github, $skill_proficient, $skill_to_learn);

        if ($stmt->execute()) {
            header("Location: home.php?success=1");
            exit();
        } else {
            echo "Error inserting data: " . $stmt->error;
        }
    } else {
        echo "Failed to upload image.";
    }
} else {
    echo "Invalid request.";
}
?>
