<?php
include 'DBConnector.php';

$sql = "
SELECT 
    s.id, s.Name, s.Age, s.Email, s.Course,
    d.YearLevel, d.GraduationStatus, d.ImagePath
FROM students s
LEFT JOIN student_details d ON s.id = d.student_id
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='table-scroll'>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Course</th>
                <th>Year</th>
                <th>Graduated</th>
                <th>Image</th>
                <th>Actions</th>
              </tr>
            </thead>
            ";

    while ($row = $result->fetch_assoc()) {
        $grad = $row['GraduationStatus']
            ? "<span class='badge-yes'>Yes</span>"
            : "<span class='badge-no'>No</span>";

        echo "<tr>
                <td class='td-id'>#{$row['id']}</td>
                <td>{$row['Name']}</td>
                <td>{$row['Age']}</td>
                <td>{$row['Email']}</td>
                <td>{$row['Course']}</td>
                <td>{$row['YearLevel']}</td>
                <td>{$grad}</td>
                <td>" . ($row['ImagePath'] ?? '—') . "</td>
                <td>
                  <div class='td-actions'>
                    <a href='edit-form.php?id={$row['id']}' class='btn btn-accent btn-sm'>Edit</a>
                    <form action='delete.php' method='POST'
                          onsubmit=\"return confirm('Delete {$row['Name']}?')\">
                      <input type='hidden' name='id' value='{$row['id']}'>
                      <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                    </form>
                  </div>
                </td>
              </tr>";
    }

    echo "</table></div>";
} else {
    echo "<div class='alert alert-error'>No students found. Register one above.</div>";
}
?>
