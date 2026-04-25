<?php
include 'DBConnector.php';


if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    

    $stmt = $conn->prepare("SELECT ImagePath FROM student_details WHERE student_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
    
    
    if ($student && !empty($student['ImagePath']) && file_exists($student['ImagePath'])) {
        unlink($student['ImagePath']);
    }
    
    // Delete the student -- also deletes the student_details record
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: student-form.html");
        exit();
    } else {
        echo "Error deleting student: " . $stmt->error;
    }
    
    $conn->close();
} else {
    header("Location: student-form.html");
    exit();
}
?>