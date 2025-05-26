<?php
require_once __DIR__ . "/../config/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $type = $_POST['type'];
    $id = $_POST['id'];
    
    try {
        switch ($type) {
            case 'events':
                $name = $_POST['name'];
                $description = $_POST['description'];
                $stmt = $mysqli->prepare("UPDATE events SET name = ?, description = ? WHERE id = ?");
                $stmt->bind_param("ssi", $name, $description, $id);
                break;
                
            case 'schedules':
                $event_id = $_POST['event_id'];
                $day_of_week = $_POST['day_of_week'];
                $start_time = $_POST['start_time'];
                $end_time = $_POST['end_time'];
                $location = $_POST['location'];
                $stmt = $mysqli->prepare("UPDATE schedules SET event_id = ?, day_of_week = ?, start_time = ?, end_time = ?, location = ? WHERE id = ?");
                $stmt->bind_param("issssi", $event_id, $day_of_week, $start_time, $end_time, $location, $id);
                break;
                
            case 'students':
                $nis = $_POST['nis'];
                $name = $_POST['name'];
                $class = $_POST['class'];
                $email = $_POST['email'];
                $stmt = $mysqli->prepare("UPDATE students SET nis = ?, name = ?, class = ?, email = ? WHERE id = ?");
                $stmt->bind_param("ssssi", $nis, $name, $class, $email, $id);
                break;
                
            default:
                throw new Exception("Invalid type");
        }
        
        $stmt->execute();
        $stmt->close();
        
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=Data updated successfully");
        exit();
    } catch (Exception $e) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=Error updating data: " . $e->getMessage());
        exit();
    }
}
?>