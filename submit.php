<?php
include 'DBConnector.php';

$name = $_POST['name'];
$age = $_POST['age'];
$email = $_POST['email'];
$course = $_POST['course'];
$yearLvl = $_POST['year_level'];

// checkbox handling grad stats
$graduated = isset($_POST['graduated']) ? 1 : 0;

$imgFilePathStr = $_POST['image'];


// insert into students table
$kuery1 = "INSERT INTO students (Name, Age, Email, Course)
           VALUES ('$name', '$age', '$email', '$course')";

if ($conn->query($kuery1) === TRUE) {

    // get last inserted student id
    $student_id = $conn->insert_id;

    // insert into student_details table
    $kuery2 = "INSERT INTO student_details (student_id, YearLevel, GraduationStatus, ImagePath)
               VALUES ('$student_id', '$yearLvl', '$graduated', '$imgFilePathStr')";

    if ($conn->query($kuery2) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error inserting details: " . $conn->error;
    }

} else {
    echo "Error inserting student: " . $conn->error;
}
?>