<?php
session_start();
require_once __DIR__ . '/../config/connect.php';
require_once __DIR__ . '/../config/security.php';
require_once __DIR__ . '/../config/baseURL.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit("Method not allowed");
}

// CSRF Protection
if (!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
    http_response_code(403);
    exit("Invalid CSRF token");
}

// Input Validation and Sanitization
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';
$remember = isset($_POST['remember_me']) && $_POST['remember_me'] === 'on';

if (!$email || empty($password)) {
    http_response_code(400);
    exit("Invalid credentials");
}

// Prepare and Execute User Query (Prevent SQL Injection)
$stmt = $mysqli->prepare("SELECT id, name, password, is_active FROM users WHERE email = ?");
if (!$stmt) {
    http_response_code(500);
    exit("Database error");
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(401);
    exit("Invalid credentials");
}

$user = $result->fetch_assoc();

// Verify Password Securely
if (!password_verify($password, $user['password'])) {
    http_response_code(401);
    exit("Invalid Password or email");
}

// Check Account Activation
if (!$user['is_active']) {
    http_response_code(403);
    exit("Account not activated");
}

// Regenerate Session ID for Security
session_regenerate_id(true);

// Set Session Variables
$_SESSION['user_id'] = $user['id'];
$_SESSION['name'] = $user['name']; // ✅ Tambahkan ini agar tidak error di header.php
$_SESSION['logged_in'] = time();

// Remember Me Token Handling
if ($remember) {
    $selector = bin2hex(random_bytes(12));
    $validator = bin2hex(random_bytes(32));
    $hashedValidator = hash('sha256', $validator);
    $expires = date('Y-m-d H:i:s', time() + 60 * 60 * 24 * 30); // 30 hari

    // Hapus token lama (optional tapi disarankan)
    $stmt = $mysqli->prepare("DELETE FROM auth_tokens WHERE user_id = ?");
    $stmt->bind_param("i", $user['id']);
    $stmt->execute();

    // Simpan token baru
    $stmt = $mysqli->prepare("INSERT INTO auth_tokens (selector, hashed_validator, user_id, expires) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $selector, $hashedValidator, $user['id'], $expires);
    if (!$stmt->execute()) {
        error_log("Failed to insert remember me token for user_id {$user['id']}");
    }

    // Set cookie aman
    setcookie(
        'remember',
        $selector . ':' . $validator,
        [
            'expires' => time() + 60 * 60 * 24 * 30,
            'path' => '/',
            'domain' => '', // sesuaikan jika perlu
            'secure' => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Strict',
        ]
    );
}

// Redirect ke dashboard
header("Location: " . BASE_URL . "admin/dashboard.php");
exit();
