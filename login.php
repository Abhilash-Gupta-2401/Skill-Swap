<?php
session_start();

// DB Connection
$host = 'localhost';
$db  = 'Gupta';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}

// Fetch form data
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    echo "<p class='error'>Please enter both email and password.</p>";
    echo '<a href="index.html">Back to login</a>';
    exit;
}

// Get user by email
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user['name'];  // store user in session
    header('Location: home.php');
    exit;
} else {
    echo "<p class='error'>Invalid email or password.</p>";
    echo '<a href="index.html">Back to login</a>';
}


?>