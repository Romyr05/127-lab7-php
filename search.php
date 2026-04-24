<?php
include 'DBConnector.php';

if (isset($_POST['searchInput'])) {

    $value = $_POST['searchInput'];

    // SQL query (search by ID OR Name)
    $sql = "SELECT * FROM students 
            WHERE id = '$value' 
            OR name = '$value'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        echo "<h2>Student Data</h2>";
        echo "<p>";
        echo "Name: " . $row['Name'] . "<br>";
        echo "Age: " . $row['Age'] . "<br>";
        echo "Email: " . $row['Email'] . "<br>";
        echo "Course: " . $row['Course'] . "<br>";
        echo "Year Level: " . $row['YearLevel'] . "<br>";
        echo "Graduated: " . ($row['GraduationStatus'] ? 'Yes' : 'No') . "<br>";
        echo "Image: " . $row['ImagePath'] . "<br>";
        echo "<hr>";
        echo "</p>";

    } else {
        echo "No record found.";
    }
}
?>