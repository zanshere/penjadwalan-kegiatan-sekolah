<?php
session_start();
require_once __DIR__ . '/../config/connect.php';
require_once __DIR__ . '/../config/security.php';
require_once __DIR__ . '/../config/baseURL.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Method not allowed");
}

// CSRF Protection
if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
    die("Invalid CSRF token");
}

// Input Validation
$name = sanitizeInput($_POST['name']);
$email = filter_var(sanitizeInput($_POST['email']), FILTER_VALIDATE_EMAIL);
$password = $_POST['password'];

if (!$email || empty($name) || empty($password)) {
    die("Invalid input data");
}

// Password Strength Validation
if (!validatePassword($password)) {
    die("Password must contain at least 8 characters, one uppercase, one lowercase, one number and one special character");
}

// Check Existing Email
$stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die("Email already registered");
}

// Hash Password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert User
$stmt = $mysqli->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashedPassword);

if ($stmt->execute()) {
    // Send verification email (optional)
    header("Location: " . BASE_URL . "auth/login.php?success=registered");
} else {
    die("Registration failed: " . $mysqli->error);
}