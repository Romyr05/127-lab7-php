<?php
include 'DBConnector.php';

if (isset($_POST['searchInput'])) {
    $value = trim($_POST['searchInput']);

    if (is_numeric($value)) {
        $stmt = $conn->prepare(
            "SELECT s.id, s.Name, s.Age, s.Email, s.Course,
                    d.YearLevel, d.GraduationStatus, d.ImagePath
             FROM students s
             LEFT JOIN student_details d ON s.id = d.student_id
             WHERE s.id = ?"
        );
        $stmt->bind_param("i", $value);
    } else {
        $stmt = $conn->prepare(
            "SELECT s.id, s.Name, s.Age, s.Email, s.Course,
                    d.YearLevel, d.GraduationStatus, d.ImagePath
             FROM students s
             LEFT JOIN student_details d ON s.id = d.student_id
             WHERE s.Name = ?"
        );
        $stmt->bind_param("s", $value);
    }


    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
    echo "
    <table border='1' cellpadding='8' cellspacing='0' margin=20>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>Course</th>
            <th>Year Level</th>
            <th>Graduated</th>
            <th>Image Path</th>
            <th>Actions</th>
        </tr>
    ";

    while ($row = $result->fetch_assoc()) {
        $grad = $row['GraduationStatus'] ? "Yes" : "No";

        echo "
        <tr>
            <td>{$row['id']}</td>
            <td>{$row['Name']}</td>
            <td>{$row['Age']}</td>
            <td>{$row['Email']}</td>
            <td>{$row['Course']}</td>
            <td>{$row['YearLevel']}</td>
            <td>{$grad}</td>
            <td>{$row['ImagePath']}</td>
            <td>
                <a href='edit-form.php?id={$row['id']}'>Edit</a>
                <form action='delete.php' method='POST' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <button type='submit'>Delete</button>
                </form>
            </td>
        </tr>
        ";
    }

    echo "</table>";

} else {
    echo "No student found.";
}

    $stmt->close();
}
?>