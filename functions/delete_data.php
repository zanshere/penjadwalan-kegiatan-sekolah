<?php
require_once __DIR__ . "/../config/connect.php";
require_once __DIR__ . "/../config/baseURL.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $type = $_POST['type'];
    $id = $_POST['id'];
    
    try {
        switch ($type) {
            case 'events':
                $stmt = $mysqli->prepare("DELETE FROM events WHERE id = ?");
                $stmt->bind_param("i", $id);
                break;
                
            case 'schedules':
                $stmt = $mysqli->prepare("DELETE FROM schedules WHERE id = ?");
                $stmt->bind_param("i", $id);
                break;
                
            case 'students':
                $stmt = $mysqli->prepare("DELETE FROM students WHERE id = ?");
                $stmt->bind_param("i", $id);
                break;
                
            default:
                throw new Exception("Invalid type");
        }
        
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=Data deleted successfully");
        } else {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=No data was deleted");
        }
        exit();
    } catch (Exception $e) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=Error deleting data: " . $e->getMessage());
        exit();
    }
}
?>