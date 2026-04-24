<?php
include 'DBConnector.php';

// Check ID
if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    
    // Get the image path to delete the image file
    $stmt = $conn->prepare("SELECT ImagePath FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
    
    // Delete the image file if it exists
    if ($student && !empty($student['ImagePath']) && file_exists($student['ImagePath'])) {
        unlink($student['ImagePath']); // Deletes the image file from server
    }
    
    // Delete the student record from database
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: student-form.php");
        exit();
    } else {
        echo "Error deleting student: " . $stmt->error;
    }
    
    $conn->close();
} else {
    // No ID provided
    header("Location: student-form.php");
    exit();
}
?>