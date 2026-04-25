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
        while ($row = $result->fetch_assoc()) {
            $grad = $row['GraduationStatus']
                ? "<span class='badge-yes'>Yes</span>"
                : "<span class='badge-no'>No</span>";

            echo "
            <div class='result-card'>
              <div class='result-card-header'>
                <h3>" . htmlspecialchars($row['Name']) . "</h3>
                <div class='result-card-actions'>
                  <a href='edit-form.php?id={$row['id']}' class='btn btn-accent btn-sm'>✏️ Edit</a>
                  <form action='delete.php' method='POST'
                        onsubmit=\"return confirm('Delete " . htmlspecialchars($row['Name'], ENT_QUOTES) . "? This cannot be undone.')\">
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <button type='submit' class='btn btn-danger btn-sm'>🗑️ Delete</button>
                  </form>
                </div>
              </div>
              <div class='result-grid'>
                <div class='result-field'>
                  <span class='rf-label'>ID</span>
                  <span class='rf-value'>#{$row['id']}</span>
                </div>
                <div class='result-field'>
                  <span class='rf-label'>Age</span>
                  <span class='rf-value'>{$row['Age']}</span>
                </div>
                <div class='result-field'>
                  <span class='rf-label'>Email</span>
                  <span class='rf-value'>" . htmlspecialchars($row['Email']) . "</span>
                </div>
                <div class='result-field'>
                  <span class='rf-label'>Course</span>
                  <span class='rf-value'>" . htmlspecialchars($row['Course']) . "</span>
                </div>
                <div class='result-field'>
                  <span class='rf-label'>Year Level</span>
                  <span class='rf-value'>{$row['YearLevel']}</span>
                </div>
                <div class='result-field'>
                  <span class='rf-label'>Graduated</span>
                  <span class='rf-value'>{$grad}</span>
                </div>
                <div class='result-field'>
                  <span class='rf-label'>Image Path</span>
                  <span class='rf-value'>" . htmlspecialchars($row['ImagePath'] ?? 'None') . "</span>
                </div>
              </div>
            </div>";
        }
    } else {
        echo "<div class='alert alert-error'>No student found matching: <strong>" . htmlspecialchars($value) . "</strong></div>";
    }

    $stmt->close();
}
?>