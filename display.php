<?php
include 'DBConnector.php';

$sql = "
SELECT 
    s.id,
    s.Name,
    s.Age,
    s.Email,
    s.Course,
    d.YearLevel,
    d.GraduationStatus,
    d.ImagePath
FROM students s
LEFT JOIN student_details d 
ON s.id = d.student_id
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Course</th>
                <th>Year Level</th>
                <th>Graduated</th>
                <th>Image</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {

        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['Name']}</td>
                <td>{$row['Age']}</td>
                <td>{$row['Email']}</td>
                <td>{$row['Course']}</td>
                <td>{$row['YearLevel']}</td>
                <td>" . ($row['GraduationStatus'] ? "Yes" : "No") . "</td>
                <td>{$row['ImagePath']}</td>
              </tr>";
    }

    echo "</table>";

} else {
    echo "No students found.";
}
?>