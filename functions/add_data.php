<?php
session_start();
require_once __DIR__ . "/../config/connect.php";
require_once __DIR__ . "/../config/baseURL.php";

// Fungsi untuk validasi CSRF token
function validate_csrf($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Fungsi untuk redirect dengan pesan
function redirect_with_message($msg, $type = 'error') {
    $_SESSION['form_' . $type] = $msg;
    header("Location: " . BASE_URL . "admin/add.php");
    exit();
}

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    redirect_with_message("Unauthorized access.");
}

// Pastikan request-nya POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_message("Invalid request method.");
}

// Validasi CSRF token
$csrf_token = $_POST['csrf_token'] ?? '';
if (!validate_csrf($csrf_token)) {
    redirect_with_message("Invalid CSRF token.");
}

// ====== Tambah EVENT ======
if (isset($_POST['name']) && !isset($_POST['event_id']) && !isset($_POST['nis'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description'] ?? '');

    if (empty($name)) {
        redirect_with_message("Event name is required.");
    }

    $stmt = $mysqli->prepare("INSERT INTO events (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $description);

    if ($stmt->execute()) {
        redirect_with_message("Event added successfully.", "success");
    } else {
        redirect_with_message("Failed to add event.");
    }
}

// ====== Tambah SCHEDULE ======
elseif (isset($_POST['event_id'], $_POST['day_of_week'], $_POST['start_time'], $_POST['end_time'])) {
    $event_id = intval($_POST['event_id']);
    $day_of_week = trim($_POST['day_of_week']);
    $start_time = trim($_POST['start_time']);
    $end_time = trim($_POST['end_time']);
    $location = trim($_POST['location'] ?? '');

    if (empty($event_id) || empty($day_of_week) || empty($start_time) || empty($end_time)) {
        redirect_with_message("All fields are required for schedule.");
    }

    $stmt = $mysqli->prepare("INSERT INTO schedules (event_id, day_of_week, start_time, end_time, location) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $event_id, $day_of_week, $start_time, $end_time, $location);

    if ($stmt->execute()) {
        redirect_with_message("Schedule added successfully.", "success");
    } else {
        redirect_with_message("Failed to add schedule.");
    }
}

// ====== Tambah STUDENT ======
elseif (isset($_POST['nis'], $_POST['name']) && !isset($_POST['event_id'])) {
    $nis = trim($_POST['nis']);
    $name = trim($_POST['name']);
    $class = trim($_POST['class']);
    $email = trim($_POST['email']);

    if (empty($nis) || empty($name)) {
        redirect_with_message("NIS, Name, Class and Email are required.");
    }

    // Cek NIS apakah sudah terdaftar
    $check = $mysqli->prepare("SELECT id FROM students WHERE nis = ?");
    $check->bind_param("s", $nis);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        redirect_with_message("Student with that NIS already exists.");
    }

    $stmt = $mysqli->prepare("INSERT INTO students (nis, name, class, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nis, $name, $class, $email);

    if ($stmt->execute()) {
        redirect_with_message("Student added successfully.", "success");
    } else {
        redirect_with_message("Failed to add student.");
    }
}

// ====== Jika tidak cocok ======
else {
    redirect_with_message("Invalid form submission.");
}
