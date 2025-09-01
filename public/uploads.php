<?php
session_start();
require '../config/database.php';

$db = new DataBase();
$conn = $db->conn;

$studentId = $_SESSION['studentId'];

// Get departmentId for the logged-in student
$deptQuery = "SELECT departmentId FROM students WHERE id = ?";
$deptStmt = $conn->prepare($deptQuery);
$deptStmt->bind_param("i", $studentId);
$deptStmt->execute();
$deptResult = $deptStmt->get_result();

if ($deptResult->num_rows === 0) {
    die("Student not found");
}

$departmentId = $deptResult->fetch_assoc()['departmentId'];

// Get assignments for this student's department
$assignmentQuery = "SELECT id, assignmentTitle 
                    FROM assignments 
                    WHERE departmentId = ? 
                    ORDER BY create_time DESC";
$stmt = $conn->prepare($assignmentQuery);
$stmt->bind_param("i", $departmentId);
$stmt->execute();
$assignmentResult = $stmt->get_result();

$assignments = [];
while ($row = $assignmentResult->fetch_assoc()) {
    $assignments[] = $row;
}

// Fetch latest submissions for this student in their department
$submissionQuery = "SELECT s.fileName, s.create_time 
                    FROM submissions s
                    INNER JOIN assignments a ON s.assignmentId = a.id
                    WHERE s.studentId = ? AND a.departmentId = ?
                    ORDER BY s.create_time DESC 
                    LIMIT 3";
$stmt = $conn->prepare($submissionQuery);
$stmt->bind_param("ii", $studentId, $departmentId);
$stmt->execute();
$submissionResult = $stmt->get_result();

$recentUploads = [];
while ($row = $submissionResult->fetch_assoc()) {
    $recentUploads[] = [
        'fileName' => htmlspecialchars($row['fileName']),
        'submittedAt' => date("M j, Y - g:i A", strtotime($row['create_time']))
    ];
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ClassTrack | Upload Assignments</title>
  <link rel="stylesheet" href="../assets/css/index.css" />
  <link href="../assets/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>

<body>
  <!-- NavBar -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand me-auto fw-bold" href="#" style="color: #2196f3">
        <i class="fas fa-graduation-cap me-2"></i>ClassTrack
      </a>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
            ClassTrack
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
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
      <a href="../controller/logout.php" class="login-button me-2">Logout</a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>
  <!-- End of NavBar -->

  <!-- Hero Header -->
  <div class="hero-header">
    <div class="container text-center">
      <h1 class="display-4 fw-bold mb-3">
        <i class="fas fa-upload me-3"></i>Upload Assignments
      </h1>
      <p class="lead">
        Submit your assignments easily and track your upload history
      </p>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-8 mb-4">
        <form action="../controller/studentUpload.php" method="post" enctype="multipart/form-data">
          <div class="upload-section">
            <h4 class="section-title">
              <i class="fas fa-cloud-upload-alt me-2"></i>Upload Assignment
            </h4>

            <!-- Hidden Assignment ID -->
            <div class="mb-4">
              <select name="assignmentId" class="form-select" required>
                <option value="">-- Select Assignment --</option>
                <?php foreach ($assignments as $assignment): ?>
                  <option value="<?= htmlspecialchars($assignment['id']) ?>">
                    <?= htmlspecialchars($assignment['assignmentTitle']) ?> (ID: <?= $assignment['id'] ?>)
                  </option>
                <?php endforeach; ?>
              </select>
            </div>


            <div class="mb-4">
              <label for="assignmentTitle" class="form-label fw-semibold">Assignment Title</label>
              <input
                type="text"
                class="form-control"
                id="assignmentTitle"
                name="title"
                placeholder="Enter assignment title"
                required />
            </div>

            <div class="upload-box mb-4">
              <i class="fas fa-cloud-upload-alt upload-icon"></i>
              <div class="upload-text">Click to Upload File</div>
              <div class="upload-subtext">
                Drag and drop files here or click to browse
              </div>
              <div class="upload-subtext mt-2">
                Supported formats: PDF, DOCX, PPT, PPTX (Max: 10MB)
              </div>
              <input
                type="file"
                name="fileUpload"
                accept=".pdf,.docx,.ppt,.pptx"
                required
                style="opacity: 0; position: absolute; left: 0; top: 0; width: 100%; height: 100%; cursor: pointer;" />
            </div>

            <div class="text-center">
              <button class="btn btn-upload btn-lg" type="submit">
                <i class="fas fa-upload me-2"></i>Upload Assignment
              </button>
            </div>
          </div>
        </form>

      </div>

      <!-- Upload History -->
      <div class="col-lg-4">
        <div class="history-card">
          <h5 class="fw-bold mb-3">
            <i class="fas fa-history me-2" style="color: #4caf50"></i>Upload History
          </h5>

          <?php if (!empty($recentUploads)): ?>
            <?php foreach ($recentUploads as $upload): ?>
              <div class="history-item mb-3">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <div class="fw-semibold"><?= $upload['fileName'] ?></div>
                    <small class="text-muted"><?= $upload['submittedAt'] ?></small>
                  </div>
                  <button class="btn btn-success-custom btn-sm">
                    <i class="fas fa-check me-1"></i>Submitted
                  </button>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="text-muted">No recent uploads found.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Upload Tips -->
    <div class="selection-card">
      <h4 class="section-title">
        <i class="far fa-lightbulb me-2"></i>Upload Tips
      </h4>
      <div class="accordion accordion-custom" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
              data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <i class="fas fa-file-check me-2"></i>Check File Format
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p class="mb-0">
                Always upload in the required format (PDF, DOCX, PPT, etc.).
                Read instructions carefully before submitting to ensure
                compatibility.
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
              data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <i class="fas fa-tag me-2"></i>Use Clear File Names
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p class="mb-0">
                Rename files to include your name, matric number, course code,
                and assignment title (e.g.,
                ReubenUweh_CMP2203_Assignment1.pdf).
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
              data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              <i class="fas fa-spell-check me-2"></i>Proofread Before
              Uploading
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p class="mb-0">
                Double-check your work for grammar, formatting, and accuracy
                before submitting—no changes after upload!
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
              data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              <i class="fas fa-exclamation-triangle me-2"></i>Avoid Blank
              Pages or Errors
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p class="mb-0">
                Open and review your file after export to ensure nothing is
                missing or corrupted before final submission.
              </p>
            </div>
          </div>
        </div>
      </div>
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
  <script src="../assets/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="../assets/js/index.js"></script>
</body>

</html>