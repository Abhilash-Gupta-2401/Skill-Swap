<?php
$host = 'localhost';      // MySQL host (usually localhost)
$db  = 'Gupta';         // Your database name
$user = 'root';           // Your MySQL username (default: root)
$pass = '';               // Your MySQL password (default is blank in XAMPP)
$charset = 'utf8mb4';

// Set up DSN and connect using PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}

// Get POST data
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$username = trim($_POST['username'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

// Validation
$errors = [];

if (!$name || !$email || !$username || !$phone || !$password || !$confirmPassword) {
    $errors[] = "All fields are required.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

// Check if email already exists
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    $errors[] = "Email already registered.";
}

// Check if Username already taken
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);
if ($stmt->fetch()) {
    $errors[] = "Username already taken.";
}

// Password validation
if (strlen($password) < 6 ||
    !preg_match('/[A-Z]/', $password) ||
    !preg_match('/[0-9]/', $password) ||
    !preg_match('/[\W_]/', $password)) {
    $errors[] = "Password must be at least 6 characters long, with 1 uppercase letter, 1 number, and 1 special character.";
}

if ($password !== $confirmPassword) {
    $errors[] = "Passwords do not match.";
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p class='error'>$error</p>";
    }
    echo '<a href="signup.html">Go back</a>';
    exit;
}

// All good - insert user
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$insert = $pdo->prepare("INSERT INTO users (name, email, username, phone, password) VALUES (?, ?, ?, ?, ?)");
$insert->execute([$name, $email, $username, $phone, $hashedPassword]);

echo "<p class='success'>Sign up successful!</p>";
echo '<a href="index.html">Back to sign in</a>';
?>