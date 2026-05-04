<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "delete.php is an action script. Please use the delete form on <a href='index.php'>index.php</a>.";
    exit();
}

include 'DBConnector.php';


if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    
    // Delete the student -- also deletes the student_details record (using ON DELETE CASCADE)
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting student: " . $stmt->error;
    }
    
    $conn->close();
} else {
    echo "delete.php needs a student ID from the delete form on <a href='index.php'>index.php</a>.";
    exit();
}
?>
