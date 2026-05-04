<?php
include 'DBConnector.php';

$id        = (int) $_POST['id'];
$name      = trim($_POST['name']);
$age       = (int) $_POST['age'];
$email     = trim($_POST['email']);
$course    = trim($_POST['course']);
$yearLvl   = (int) $_POST['year_level'];
$graduated = isset($_POST['graduated']) ? 1 : 0;

// upmail validation
if (!preg_match('/.+@up\.edu\.ph$/', $email)) {
    die("Error: Email must be a UP address ending in @up.edu.ph");
}

// new image handling
$imgFilePathStr = $_POST['existing_image']; 
if (!empty($_FILES['image']['name'])) {
    if (!is_dir('images')) mkdir('images', 0755, true);
    $ext      = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filename = uniqid('img_', true) . '.' . $ext;
    $dest     = 'images/' . $filename;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
        $imgFilePathStr = $dest;
    } else {
        die("Error: Failed to upload image.");
    }
}

// update students table
$stmt = $conn->prepare(
    "UPDATE students SET Name=?, Age=?, Email=?, Course=? WHERE id=?"
);
$stmt->bind_param("sissi", $name, $age, $email, $course, $id);

if ($stmt->execute()) {
    $stmt->close();

    // update student_details table
    $stmt2 = $conn->prepare(
        "UPDATE student_details SET YearLevel=?, GraduationStatus=?, ImagePath=?
         WHERE student_id=?"
    );
    $stmt2->bind_param("iisi", $yearLvl, $graduated, $imgFilePathStr, $id);

    if ($stmt2->execute()) {
        $stmt2->close();
        $conn->close();
        header("Location:index.php");
        exit();
    } else {
        echo "Error updating details: " . $stmt2->error;
    }
} else {
    echo "Error updating student: " . $stmt->error;
}

$conn->close();
?>
