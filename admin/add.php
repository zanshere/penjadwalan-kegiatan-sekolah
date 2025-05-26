<?php
require_once __DIR__ . "/../config/baseURL.php";
include "../config/connect.php";
include "../includes/header.php";

// Security checks
if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "/login.php");
    exit();
}

// Initialize variables
$error = '';
$success = '';

// Generate CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Data</title>
    <link href="<?= BASE_URL ?>src/css/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Add New Data</h1>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-error mb-6">
                    <div class="flex-1">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <label><?= htmlspecialchars($error) ?></label>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success mb-6">
                    <div class="flex-1">
                        <i class="bi bi-check-circle-fill"></i>
                        <label><?= htmlspecialchars($success) ?></label>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Cards Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Event Card -->
                <div class="card bg-base-100 shadow-md hover:shadow-lg transition-shadow">
                    <div class="card-body items-center text-center">
                        <i class="bi bi-calendar-event text-5xl text-primary"></i>
                        <h2 class="card-title mt-2">Add Event</h2>
                        <p class="text-sm text-gray-500">Create a new school event</p>
                        <div class="card-actions mt-4">
                            <label for="event-modal" class="btn btn-primary modal-button">
                                <i class="bi bi-plus-lg"></i> Add Event
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Schedule Card -->
                <div class="card bg-base-100 shadow-md hover:shadow-lg transition-shadow">
                    <div class="card-body items-center text-center">
                        <i class="bi bi-clock-history text-5xl text-secondary"></i>
                        <h2 class="card-title mt-2">Add Schedule</h2>
                        <p class="text-sm text-gray-500">Schedule for an event</p>
                        <div class="card-actions mt-4">
                            <label for="schedule-modal" class="btn btn-secondary modal-button">
                                <i class="bi bi-plus-lg"></i> Add Schedule
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Student Card -->
                <div class="card bg-base-100 shadow-md hover:shadow-lg transition-shadow">
                    <div class="card-body items-center text-center">
                        <i class="bi bi-people text-5xl text-accent"></i>
                        <h2 class="card-title mt-2">Add Student</h2>
                        <p class="text-sm text-gray-500">Register new student</p>
                        <div class="card-actions mt-4">
                            <label for="student-modal" class="btn btn-accent modal-button">
                                <i class="bi bi-plus-lg"></i> Add Student
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Modal -->
    <input type="checkbox" id="event-modal" class="modal-toggle">
    <div class="modal">
        <div class="modal-box relative">
            <label for="event-modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <h3 class="text-lg font-bold">Add New Event</h3>
            
            <form method="POST" action="<?= BASE_URL ?>functions/add_data.php" class="space-y-4 mt-4">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <div class="form-control">
                    <label class="label" for="event-name">
                        <span class="label-text">Event Name</span>
                        <span class="label-text-alt text-error">* Required</span>
                    </label>
                    <input type="text" id="event-name" name="name" class="input input-bordered w-full" required>
                </div>

                <div class="form-control">
                    <label class="label" for="event-description">
                        <span class="label-text">Description</span>
                    </label>
                    <textarea id="event-description" name="description" rows="4" class="textarea textarea-bordered w-full"></textarea>
                </div>

                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save Event
                    </button>
                    <label for="event-modal" class="btn">Cancel</label>
                </div>
            </form>
        </div>
    </div>

    <!-- Schedule Modal -->
    <input type="checkbox" id="schedule-modal" class="modal-toggle">
    <div class="modal">
        <div class="modal-box relative">
            <label for="schedule-modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <h3 class="text-lg font-bold">Add New Schedule</h3>
            
            <form method="POST" action="<?= BASE_URL ?>functions/add_data.php" class="space-y-4 mt-4">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <div class="form-control">
                    <label class="label" for="schedule-event">
                        <span class="label-text">Event</span>
                        <span class="label-text-alt text-error">* Required</span>
                    </label>
                    <select id="schedule-event" name="event_id" class="select select-bordered w-full" required>
                        <option value="" disabled selected>Select Event</option>
                        <?php
                        $events = $mysqli->query("SELECT id, name FROM events ORDER BY name");
                        while ($event = $events->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($event['id']) . '">' . htmlspecialchars($event['name']) . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-control">
                    <label class="label" for="schedule-day">
                        <span class="label-text">Day of Week</span>
                        <span class="label-text-alt text-error">* Required</span>
                    </label>
                    <select id="schedule-day" name="day_of_week" class="select select-bordered w-full" required>
                        <option value="" disabled selected>Select Day</option>
                        <option value="Senin">Monday</option>
                        <option value="Selasa">Tuesday</option>
                        <option value="Rabu">Wednesday</option>
                        <option value="Kamis">Thursday</option>
                        <option value="Jumat">Friday</option>
                        <option value="Sabtu">Saturday</option>
                        <option value="Minggu">Sunday</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-control">
                        <label class="label" for="start-time">
                            <span class="label-text">Start Time</span>
                            <span class="label-text-alt text-error">* Required</span>
                        </label>
                        <input type="time" id="start-time" name="start_time" class="input input-bordered w-full" required>
                    </div>

                    <div class="form-control">
                        <label class="label" for="end-time">
                            <span class="label-text">End Time</span>
                            <span class="label-text-alt text-error">* Required</span>
                        </label>
                        <input type="time" id="end-time" name="end_time" class="input input-bordered w-full" required>
                    </div>
                </div>

                <div class="form-control">
                    <label class="label" for="location">
                        <span class="label-text">Location</span>
                    </label>
                    <input type="text" id="location" name="location" class="input input-bordered w-full">
                </div>

                <div class="modal-action">
                    <button type="submit" class="btn btn-secondary">
                        <i class="bi bi-save"></i> Save Schedule
                    </button>
                    <label for="schedule-modal" class="btn">Cancel</label>
                </div>
            </form>
        </div>
    </div>

    <!-- Student Modal -->
    <input type="checkbox" id="student-modal" class="modal-toggle">
    <div class="modal">
        <div class="modal-box relative">
            <label for="student-modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <h3 class="text-lg font-bold">Add New Student</h3>
            
            <form method="POST" action="<?= BASE_URL ?>functions/add_data.php" class="space-y-4 mt-4">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <div class="form-control">
                    <label class="label" for="student-nis">
                        <span class="label-text">Student ID (NIS)</span>
                        <span class="label-text-alt text-error">* Required</span>
                    </label>
                    <input type="text" id="student-nis" name="nis" class="input input-bordered w-full" required>
                </div>

                <div class="form-control">
                    <label class="label" for="student-name">
                        <span class="label-text">Full Name</span>
                        <span class="label-text-alt text-error">* Required</span>
                    </label>
                    <input type="text" id="student-name" name="name" class="input input-bordered w-full" required>
                </div>

                <div class="form-control">
                    <label class="label" for="student-class">
                        <span class="label-text">Class</span>
                    </label>
                    <input type="text" id="student-class" name="class" class="input input-bordered w-full">
                </div>

                <div class="form-control">
                    <label class="label" for="student-email">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" id="student-email" name="email" class="input input-bordered w-full">
                </div>

                <div class="modal-action">
                    <button type="submit" class="btn btn-accent">
                        <i class="bi bi-save"></i> Save Student
                    </button>
                    <label for="student-modal" class="btn">Cancel</label>
                </div>
            </form>
        </div>
    </div>

    <!-- Javascript -->
     <script src="<?= BASE_URL?>src/js/showMessage.js"></script>
</body>
</html>