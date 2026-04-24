<?php
    include 'DBConnector.php';

    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
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
        }

    } else {
        echo "No students found.";
    }
    ?>