<?php
include 'DBConnector.php';

if (!isset($_GET['id']) || trim($_GET['id']) === '') {
    echo "edit-form.php needs a student ID in the URL, like <a href='edit-form.php?id=1'>edit-form.php?id=1</a>. You can choose a student from <a href='index.php'>index.php</a>.";
    exit();
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare(
    "SELECT s.id, s.Name, s.Age, s.Email, s.Course,
            d.YearLevel, d.GraduationStatus, d.ImagePath
     FROM students s
     JOIN student_details d ON s.id = d.student_id
     WHERE s.id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$row) die("Student not found.");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Student Info — UP Registry</title>
  <link rel="stylesheet" href="style-edit-form.css">
</head>
<body>
<div class="page-wrapper">

  <header class="site-header">
    <div class="logo">
      <span class="logo-eyebrow">University of the Philippines</span>
      <span class="logo-title">Student <span>Registry</span></span>
    </div>
    <a href="index.php" class="btn btn-ghost">← Back to Dashboard</a>
  </header>

  <section>
    <h2 class="section-title"><span class="section-icon"></span> Edit Student Record</h2>
    <div class="card">
      <form action="update.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <input type="hidden" name="existing_image" value="<?= htmlspecialchars($row['ImagePath'] ?? '') ?>">

        <div class="form-grid">

          <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" maxlength="40"
                   value="<?= htmlspecialchars($row['Name']) ?>" required>
          </div>

          <div class="form-group">
            <label>Age <span class="field-hint">0 - 99</span></label>
            <input type="number" name="age" min="0" max="99"
                   value="<?= $row['Age'] ?>" required>
          </div>

          <div class="form-group">
            <label>Email <span class="field-hint">@up.edu.ph only</span></label>
            <input type="email" name="email" maxlength="40"
                   pattern=".+@up\.edu\.ph"
                   title="Must end in @up.edu.ph"
                   value="<?= htmlspecialchars($row['Email']) ?>" required>
          </div>

          <div class="form-group">
            <label>Course</label>
            <input type="text" name="course" maxlength="40"
                   value="<?= htmlspecialchars($row['Course']) ?>" required>
          </div>

          <div class="form-group">
            <label>Year Level</label>
            <select name="year_level" required>
              <?php foreach ([1,2,3,4] as $y): ?>
                <option value="<?= $y ?>" <?= $row['YearLevel'] == $y ? 'selected' : '' ?>>
                  <?= $y ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label>Graduation Status</label>
            <label class="checkbox-row">
              <input type="checkbox" name="graduated" value="1"
                     <?= $row['GraduationStatus'] ? 'checked' : '' ?>>
              <span class="checkbox-label-text">Mark as Graduated</span>
            </label>
          </div>

          <div class="form-group full-width">
            <label>New Profile Photo <span class="field-hint">Leave blank to keep current</span></label>
            <?php if (!empty($row['ImagePath'])): ?>
              <p style="font-size:0.8rem; color:var(--cream-dim); margin-bottom:6px;">
                Current: <?= htmlspecialchars($row['ImagePath']) ?>
              </p>
            <?php endif; ?>
            <input type="text" name="image"">
          </div>

        </div>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save Changes</button>
          <a href="index.php" class="btn btn-ghost">Cancel</a>
        </div>

      </form>
    </div>
  </section>


</div>
</body>
</html>
