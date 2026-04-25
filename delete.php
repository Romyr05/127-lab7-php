<?php
include 'DBConnector.php';


if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    
    // Delete the student -- also deletes the student_details record (using ON DELETE CASCADE)
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
    header("Location: student-form.php");
    exit();
}
?>