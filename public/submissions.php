<?php
session_start();
require '../config/database.php';

$db = new DataBase();
$conn = $db->conn;

// Replace this with actual student/admin ID if needed
$studentId = $_SESSION['studentId'] ?? null;

$sql = "SELECT 
            submissions.id AS submissionId,
            submissions.create_time AS submissionTime,
            submissions.title AS submissionTitle,
            submissions.fileName,
            submissions.status,
            assignments.assignmentTitle,
            assignments.assignmentDescription,
            assignments.endDate
        FROM submissions
        INNER JOIN assignments ON submissions.assignmentId = assignments.id
        WHERE submissions.studentId = ?
        ORDER BY submissions.create_time DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $studentId);
$stmt->execute();
$result = $stmt->get_result();

$submissions = [];
while ($row = $result->fetch_assoc()) {
  $submissions[] = $row;
}

// Total Submissions
$totalQuery = "SELECT COUNT(*) AS total FROM submissions";
$total = $conn->query($totalQuery)->fetch_assoc()['total'];


// Late Submissions: those submitted after assignment endDate
$lateQuery = "
SELECT COUNT(*) AS late 
FROM submissions s
JOIN assignments a ON s.assignmentId = a.id
WHERE s.create_time > a.endDate
";
$late = $conn->query($lateQuery)->fetch_assoc()['late'];

// Total Submissions
$totalQuery = "SELECT COUNT(*) AS total FROM submissions";
$total = $conn->query($totalQuery)->fetch_assoc()['total'];

// Late Submissions: those submitted after assignment endDate
$lateQuery = "
SELECT COUNT(*) AS late 
FROM submissions s
JOIN assignments a ON s.assignmentId = a.id
WHERE s.create_time > a.endDate
";
$late = $conn->query($lateQuery)->fetch_assoc()['late'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ClassTrack | My Submissions</title>
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
        <i class="fas fa-clipboard-list me-3"></i>My Submissions
      </h1>
      <p class="lead">
        Track all your submitted assignments and their status
      </p>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container">
    <!-- Statistics Cards -->
    <div class="row mb-4">
      <div class="col-md-6 mb-4">
        <div class="stats-card">
          <div class="stats-number"><?= $total ?></div>
          <div class="stats-label">
            <i class="fas fa-check-circle me-1"></i>
            Total Submissions
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="stats-card">
          <div class="stats-number"><?= $late ?></div>
          <div class="stats-label">
            <i class="fas fa-clock me-1"></i>
            Late Submissions
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Submissions List -->
  <div class="container">
    <h4 class="mt-4 mb-3"><i class="fas fa-clock me-2"></i>Recent Submissions</h4>
    <?php if (count($submissions) > 0): ?>
      <?php foreach ($submissions as $submission): ?>
        <div class="submission-card mb-3 p-3 border rounded">
          <div class="d-flex justify-content-between">
            <strong><?= htmlspecialchars($submission['assignmentTitle']) ?></strong>
            <span class="badge bg-<?= $submission['status'] === 'submitted' ? 'success' : ($submission['status'] === 'pending' ? 'inavlid' : 'danger') ?>">
              <?= ucfirst($submission['status']) ?>
            </span>
          </div>
          <div class="small text-muted mb-2">
            Submitted on <?= date("F jS, Y \\a\\t g:i A", strtotime($submission['submissionTime'])) ?>
          </div>
          <p><?= htmlspecialchars($submission['assignmentDescription']) ?></p>
          <?php if ($submission['fileName']): ?>
            <span class="badge bg-primary"><i class="fas fa-file-alt me-1"></i><?= htmlspecialchars($submission['fileName']) ?></span>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="alert alert-info">No submissions yet.</div>
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