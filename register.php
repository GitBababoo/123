<?php
require_once 'config.php';

// Function to sanitize user input
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

if (isset($_POST['register'])) {
    // Sanitize and validate user input
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];
    $phone_number = sanitizeInput($_POST['phone_number']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.');</script>";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = $created_at;

    try {
        // Check if the user already exists
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Email already exists.');</script>";
        } else {
            // Insert new user into the database
            $stmt = $pdo->prepare("INSERT INTO user (name, email, password, phone_number, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $hashedPassword, $phone_number, $created_at, $updated_at]);
            echo "<script>alert('Registration successful!'); window.location.href = 'login.php';</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Database error: " . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container register-container">
    <h2 class="text-center mb-4">Register</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phone_number" name="phone_number">
        </div>
        <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
    </form>
</div>
</body>
</html>
