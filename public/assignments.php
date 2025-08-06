<?php
session_start();
require '../config/database.php';

$studentId = $_SESSION['studentId'];

$db = new DataBase();
$conn = $db->conn;

// Getting the student's department ID
$deptSql = "SELECT departmentId FROM students WHERE id = ?";
$deptStmt = $conn->prepare($deptSql);
$deptStmt->bind_param("i", $studentId);
$deptStmt->execute();
$deptResult = $deptStmt->get_result();

if ($deptResult->num_rows > 0) {
  $student = $deptResult->fetch_assoc();
  $departmentId = $student['departmentId'];
} else {
  die("Student not found.");
}
// Fetch assignments for that department
$assignmentSql = "SELECT * FROM assignments WHERE departmentId = ? ORDER BY endDate DESC LIMIT 5";
$assignmentStmt = $conn->prepare($assignmentSql);
$assignmentStmt->bind_param("i", $departmentId);
$assignmentStmt->execute();
$assignmentsResult = $assignmentStmt->get_result();

$totalAssignments = 0;
$pendingCount = 0;
$completedCount = 0;
$overdueCount = 0;
$today = date('Y-m-d');

$assignmentStmt->execute();
$allAssignmentsResult = $assignmentStmt->get_result();

while ($row = $allAssignmentsResult->fetch_assoc()) {
  $totalAssignments++;

  if ($today > $row['endDate']) {
    $overdueCount++;
  } elseif ($today >= $row['startDate'] && $today <= $row['endDate']) {
    $pendingCount++;
  } else {
    $completedCount++; // I will make adjusting here in the future process incase logic changes
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ClassTrack | My Assignments</title>
  <link rel="stylesheet" href="/assets/css/index.css" />
  <link href="/assets/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
</head>

<body>
  <!-- NavBar -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand me-auto" href="#">ClassTrack</a>
      <div
        class="offcanvas offcanvas-end"
        tabindex="-1"
        id="offcanvasNavbar"
        aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
            ClassTrack
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="uploads.php">Uploads</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="assignments.php">Assignments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="submissions.php">Submissions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="feedback.php">Feedbacks</a>
            </li>
          </ul>
        </div>
      </div>
      <a href="/controller/logout.php" class="login-button me-2">Logout</a>
      <button
        class="navbar-toggler border-0"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <!-- Hero Header -->
  <div class="hero-header">
    <div class="container text-center">
      <h1 class="display-4 fw-bold mb-3">
        <i class="fas fa-tasks me-3"></i>My Assignments
      </h1>
      <p class="lead">Stay on top of your academic responsibilities</p>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container">
    <!-- Statistics Cards -->
    <div class="row mb-4">
      <div class="col-md-3 mb-3">
        <div class="stats-card">
          <div class="stats-number"><?= $totalAssignments ?></div>
          <div class="stats-label">
            <i class="fas fa-tasks me-1"></i>
            Total Assignments
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="stats-card">
          <div class="stats-number"><?= $pendingCount ?></div>
          <div class="stats-label">
            <i class="fas fa-hourglass-half me-1"></i>
            Pending
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="stats-card">
          <div class="stats-number"><?= $completedCount ?></div>
          <div class="stats-label">
            <i class="fas fa-check-circle me-1"></i>
            Completed
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="stats-card">
          <div class="stats-number"><?= $overdueCount ?></div>
          <div class="stats-label">
            <i class="fas fa-exclamation-triangle me-1"></i>
            Overdue
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- Assignments List -->
  <div class="assignments-container">
    <h4 class="section-title">
      <i class="fas fa-list me-2"></i>Assignment List
    </h4>

    <?php if ($assignmentsResult->num_rows > 0): ?>
      <?php while ($row = $assignmentsResult->fetch_assoc()): ?>
        <div class="assignment-card">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="course-code">Assignment</div>
            <div class="status-badge status-pending">
              <i class="fas fa-hourglass-half"></i>
              Pending
            </div>
          </div>
          <div class="assignment-date">
            <i class="fas fa-calendar me-1"></i>
            Start: <span class="due-date"><?= date('M d, Y', strtotime($row['startDate'])) ?></span> |
            End: <?= date('M d, Y', strtotime($row['endDate'])) ?>
          </div>
          <div class="assignment-title">
            <h4><?= nl2br(htmlspecialchars($row['assignmentTitle'])) ?></h4>
          </div>
          <div class="assignment-description">
            <?= nl2br(htmlspecialchars($row['assignmentDescription'])) ?>
          </div>
          <div class="mt-3 d-flex justify-content-between align-items-center">
            <div>
              <span class="badge bg-primary me-2">
                <i class="fas fa-book me-1"></i>
                <?= htmlspecialchars($row['assignmentTitle']) ?>
              </span>
              <span class="badge bg-secondary">
                <?= htmlspecialchars($row['allowedFileTypes']) ?>
              </span>
            </div>
            <a href="submit-assignment.php?id=<?= $row['id'] ?>" class="btn-gradient">Submit</a>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No assignments available for your department.</p>
    <?php endif; ?>

  </div>
  </div>

  <!-- Footer -->
  <footer class="bg-primary text-white py-4 mt-5 text-center">
    <p class="mb-1">© 2025 ClassTask Portal. All rights reserved.</p>
    <p class="small">
      Developed by Reuben Uweh · Student Project · Dept. of Software
      Engineering
    </p>
  </footer>

  <!-- Scripts -->
  <script src="/assets/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>