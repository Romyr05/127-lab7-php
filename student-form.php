<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UP Student Registration</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="page-wrapper">

  <header class="site-header">
    <div class="logo">
      <span class="logo-eyebrow">University of the Philippines</span>
      <span class="logo-title">Student <span>Registry</span></span>
    </div>
    <span class="header-badge">student-test · PHP + MySQL</span>
  </header>

  <!-- REGISTER -->
  <section>
    <h2 class="section-title"><span class="section-icon"></span> Register New Student</h2>
    <div class="card">
      <form action="submit.php" method="POST" enctype="multipart/form-data">
        <div class="form-grid">

          <div class="form-group">
            <label>Full Name <span class="field-hint">MAXCHAR(40)</span></label>
            <input type="text" name="name" maxlength="40" placeholder="e.g. Juan dela Cruz" required>
          </div>

          <div class="form-group">
            <label>Age <span class="field-hint">0 - 99</span></label>
            <input type="number" name="age" min="0" max="99" placeholder="e.g. 20" required>
          </div>

          <div class="form-group">
            <label>Email <span class="field-hint">@up.edu.ph only</span></label>
            <input type="email" name="email" maxlength="40"
                   pattern=".+@up\.edu\.ph"
                   title="Must be a UP email ending in @up.edu.ph"
                   placeholder="juandelacruz@up.edu.ph" required>
          </div>

          <div class="form-group">
            <label>Course <span class="field-hint">MAXCHAR(40)</span></label>
            <input type="text" name="course" maxlength="40" placeholder="e.g. BS Computer Science" required>
          </div>

          <div class="form-group">
            <label>Year Level <span class="field-hint">1 - 4</span></label>
            <select name="year_level" required>
              <option value="" disabled selected>Select year…</option>
              <option value="1">1st Year</option>
              <option value="2">2nd Year</option>
              <option value="3">3rd Year</option>
              <option value="4">4th Year</option>
            </select>
          </div>

          <div class="form-group">
            <label>Graduation Status <span class="field-hint">CHECK</span></label>
            <label class="checkbox-row">
              <input type="checkbox" name="graduated" value="1">
              <span class="checkbox-label-text">Mark as Graduated</span>
            </label>
          </div>

          <div class="form-group full-width">
            <label>Profile Photo <span class="field-hint">Saved to images</span></label>
            <input type="file" name="image" accept="image/*">
          </div>

        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary"> Register Student</button>
          <button type="reset" class="btn btn-ghost">Clear</button>
        </div>
      </form>
    </div>
  </section>

  <hr class="divider">

  <!-- SEARCH -->
  <section>
    <h2 class="section-title"><span class="section-icon"></span> Search Student</h2>
    <div class="card">
      <form action="student-form.php" method="POST">
        <div class="search-row">
          <input type="text" name="searchInput" placeholder="Enter student ID or name…">
          <button type="submit" class="btn btn-accent">Search</button>
        </div>
      </form>
      <div">
        <?php include 'search.php'; ?>
      </div>
    </div>
  </section>

  <hr class="divider">

  <!-- DELETE BY ID -->
  <section>
    <h2 class="section-title"><span class="section-icon"></span> Delete Student</h2>
    <div class="card">
      <form action="delete.php" method="POST"
            onsubmit="return confirm('Delete this student? This cannot be undone.')">
        <div class="search-row">
          <input type="number" name="id" placeholder="Enter student ID…" required>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </section>

  <hr class="divider">

  <!-- STUDENT LIST -->
  <section>
    <h2 class="section-title"><span class="section-icon"></span> All Students</h2>
    <?php include 'display.php'; ?>
  </section>


</div>
</body>
</html>
