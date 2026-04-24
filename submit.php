<?php
include 'DBConnector.php';

$name = $_POST['name'];
$age = $_POST['age'];
$email = $_POST['email'];
$course = $_POST['course'];
$yearLvl = $_POST['year_level'];
$graduated = $_POST['graduated'];
$imgFilePathStr = $_POST['image'];



$kuery = "INSERT INTO students( 
            Name,
            Age ,
            Email,
            Course,
            YearLevel,
            GraduationStatus,
            ImagePath) VALUES ('$name', '$age', '$email', '$course', '$yearLvl', '$graduated', '$imgFilePathStr');";

if ($conn->query($kuery) === TRUE){
    header("Location: student-form.php");
    exit();
} else {
    echo "Error" . $conn->error;
}




?>