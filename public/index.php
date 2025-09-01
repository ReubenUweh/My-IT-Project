<?php
session_start();
require "../config/database.php";

if (!isset($_SESSION['studentId'])) {
  header("Location: ./login.php");
  exit();
}

//fetch student data
$db = new DataBase();
$conn = $db->conn;
$studentId = $_SESSION['studentId'];

$sql = "SELECT s.firstName, s.lastName, s.matricNo, d.departmentName, f.facultyName
        FROM students s
        JOIN departments d ON s.departmentId = d.id
        JOIN faculties f ON d.facultyId = f.id
        WHERE s.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $studentId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// 1. Feedback submitted by this student
$feedbackQuery = $conn->prepare("
    SELECT COUNT(*) AS totalFeedback 
    FROM feedbacks 
    WHERE matricNo = (
        SELECT matricNo FROM students WHERE id = ?
    )
");
$feedbackQuery->bind_param("i", $studentId);
$feedbackQuery->execute();
$feedbackResult = $feedbackQuery->get_result()->fetch_assoc();
$feedbackSubmitted = (int)($feedbackResult['totalFeedback'] ?? 0);

// 2. Assignments submitted by this student
$submittedQuery = $conn->prepare("
    SELECT COUNT(*) AS totalSubmitted 
    FROM submissions 
    WHERE status = 'submitted' 
    AND studentId = ?
");
$submittedQuery->bind_param("i", $studentId);
$submittedQuery->execute();
$submittedResult = $submittedQuery->get_result()->fetch_assoc();
$assignmentsSubmitted = (int)($submittedResult['totalSubmitted'] ?? 0);

// 3. Pending assignments for this student
$pendingQuery = $conn->prepare("
    SELECT COUNT(*) AS totalPending 
    FROM submissions 
    WHERE status = 'pending' 
    AND studentId = ?
");
$pendingQuery->bind_param("i", $studentId);
$pendingQuery->execute();
$pendingResult = $pendingQuery->get_result()->fetch_assoc();
$pendingAssignments = (int)($pendingResult['totalPending'] ?? 0);

//alert assignments
$sql = "SELECT assignmentTitle, endDate FROM assignments ORDER BY create_time DESC LIMIT 1";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ClassTrack</title>
  <link rel="stylesheet" href="../assets/css/index.css" />
  <link href="../assets/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
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
      <a href="../controller/logout.php" class="login-button me-2">Logout</a>
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

  <!-- Hero Section -->
  <div class="container-fluid px-4">
    <?php if ($result && $result->num_rows > 0): ?>
      <?php
      $row = $result->fetch_assoc();
      echo '<div class="alert alert-info shadow-sm">
            <strong><i class="fas fa-bell me-2"></i>New Assignment:</strong>
            <b>' . htmlspecialchars($row['assignmentTitle']) . '</b> due on
            <span class="text-danger fw-bold">' . date('M d', strtotime($row['endDate'])) . '</span>
        </div>';
      ?>
    <?php else: ?>
      <div class="alert alert-warning">
        <strong>No New Assignments</strong>
      </div>
    <?php endif; ?>

    <div class="container">
      <!-- User Profile Section -->
      <div class="user-profile-section">
        <div class="row align-items-center">
          <div class="col-auto">
            <img
              src="../assets/images/profile.png"
              alt="Profile"
              class="profile-image"
              width="145"
              height="145" />
          </div>
          <div class="col name-section">
            <h2 class="mb-2"><?= htmlspecialchars($user['firstName'] . ' ' . $user['lastName']) ?></h2>
            <p class="fs-5 fw-bold text-muted mb-1"><?= htmlspecialchars($user['facultyName']) ?></p>
            <p class="fw-bold text-muted mb-1"><?= htmlspecialchars($user['departmentName']) ?></p>
            <small class="badge bg-primary">MatricNo: <?= htmlspecialchars($user['matricNo']) ?></small>

          </div>
        </div>
      </div>

      <!-- Statistics Section -->
      <h3 class="section-title">My Reviews</h3>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card stat-card h-100">
            <div
              class="card-body text-center d-flex flex-column justify-content-center">
              <h1 class="card-title mb-3"><?php echo $assignmentsSubmitted; ?></h1>
              <p class="card-text fw-bold mb-0">
                Assignment Submitted
                <i class="fas fa-file-alt ms-2 text-primary"></i>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card stat-card h-100">
            <div
              class="card-body text-center d-flex flex-column justify-content-center">
              <h1 class="card-title mb-3"><?php echo $pendingAssignments; ?></h1>
              <p class="card-text fw-bold mb-0">
                Pending Assignments
                <i class="far fa-hourglass ms-2 text-warning"></i>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card stat-card h-100">
            <div
              class="card-body text-center d-flex flex-column justify-content-center">
              <h1 class="card-title mb-3"><?php echo $feedbackSubmitted; ?></h1>
              <p class="card-text fw-bold mb-0">
                Feedbacks Submitted
                <i class="fas fa-receipt ms-2 text-success"></i>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Progress Summary -->
      <div class="row mt-5">
        <div class="col-12">
          <h5 class="text-start mb-3 text-primary fw-bold">
            Progress Summary
          </h5>
          <div
            class="progress"
            role="progressbar"
            aria-label="Progress"
            aria-valuenow="75"
            aria-valuemin="0"
            aria-valuemax="100">
            <div
              class="progress-bar progress-bar-striped progress-bar-animated fw-bold"
              style="width: 75%">
              75%
            </div>
          </div>
        </div>
      </div>

      <!-- Study Tips Section -->
      <h4 class="section-title">
        Study Tips and Resources
        <i class="fas fa-book ms-2"></i>
      </h4>

      <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button
              class="accordion-button"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseOne"
              aria-expanded="true"
              aria-controls="panelsStayOpen-collapseOne">
              <i class="far fa-clock me-2"></i>
              Time Management Strategies
            </button>
          </h2>
          <div
            id="panelsStayOpen-collapseOne"
            class="accordion-collapse collapse show">
            <div class="accordion-body">
              <p>
                <strong>Using Planners:</strong> Staying organized is easier
                with a planner. Write down your deadlines, exams, and study
                sessions for better focus daily.
              </p>
              <p>
                <strong>To-Do Lists:</strong> A daily checklist helps students
                prioritize tasks, avoid forgetting assignments, and feel
                accomplished by ticking off completed work.
              </p>
              <p>
                <strong>Time-Blocking Method:</strong> Divide your day into
                study blocks. Assign subjects to specific time slots to boost
                efficiency and reduce time-wasting habits.
              </p>
              <p>
                <strong>Pomodoro Study Technique:</strong> Study 25 minutes,
                then rest 5 minutes. This proven method helps improve
                concentration and prevents student burnout during long
                sessions.
              </p>
              <p>
                <strong>Useful Productivity Apps:</strong> Apps like Notion,
                Trello, and Google Calendar help schedule classes, track
                goals, and manage assignments with smart notifications.
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseTwo"
              aria-expanded="false"
              aria-controls="panelsStayOpen-collapseTwo">
              <i class="fa fa-bed me-2"></i>
              Dealing with Procrastination
            </button>
          </h2>
          <div
            id="panelsStayOpen-collapseTwo"
            class="accordion-collapse collapse">
            <div class="accordion-body">
              <p>
                <strong>2-minute Rule:</strong> Start small with tasks under
                two minutes, or tackle the hardest task first to gain momentum
                and boost your daily productivity.
              </p>
              <p>
                <strong>Procrastination:</strong> Procrastination often comes
                from fear, boredom, or overwhelm. Recognizing your trigger
                helps break the habit and build better focus routines.
              </p>
              <p>
                <strong>Technique:</strong> Use Forest App to stay off your
                phone, or Pomodoro to focus in 25-minute bursts followed by
                short breaks for mental recharge.
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseThree"
              aria-expanded="false"
              aria-controls="panelsStayOpen-collapseThree">
              <i class="fa fa-book-open me-2"></i>
              Group Study vs Solo Study
            </button>
          </h2>
          <div
            id="panelsStayOpen-collapseThree"
            class="accordion-collapse collapse">
            <div class="accordion-body">
              <p>
                <strong>Pros and Cons:</strong> Studying alone allows full
                focus and personal pace, while group study encourages
                discussion, idea sharing, and accountability but may distract.
              </p>
              <p>
                <strong>Rules:</strong> Use partners for difficult topics, set
                clear goals, time limits, roles, and avoid off-topic chats to
                stay productive and respectful.
              </p>
              <p>
                <strong>Web Spaces:</strong> Schedule sessions in advance,
                share links, enable screen sharing, mute when not talking, and
                use breakout rooms for better collaboration focus.
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseFour"
              aria-expanded="false"
              aria-controls="panelsStayOpen-collapseFour">
              <i class="far fa-lightbulb me-2"></i>
              Exam Preparation Tips
            </button>
          </h2>
          <div
            id="panelsStayOpen-collapseFour"
            class="accordion-collapse collapse">
            <div class="accordion-body">
              <p>
                <strong>Tips on Creating a Revision Timetable:</strong> Break
                subjects into daily slots. Prioritize weak areas. Stick to a
                schedule that includes short breaks to avoid burnout and
                distractions.
              </p>
              <p>
                <strong>Simulate Questions:</strong> Practice past questions
                with a timer in a quiet space. Avoid using notes to replicate
                real exam stress and boost confidence.
              </p>
              <p>
                <strong>Mentality:</strong> Visualize success, stay positive,
                and avoid comparing with others. Prepare well, breathe deeply,
                and trust your efforts during stressful moments.
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Carousel Section -->
      <div id="carouselExampleFade" class="carousel slide carousel-fade">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              src="../assets/images/Uni-space.jpg"
              class="d-block w-100"
              alt="University Campus" />
          </div>
          <div class="carousel-item">
            <img
              src="../assets/images/classroom-student.jpg"
              class="d-block w-100"
              alt="Classroom" />
          </div>
          <div class="carousel-item">
            <img
              src="../assets/images/grad.jpg"
              class="d-block w-100"
              alt="Graduation" />
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExampleFade"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#carouselExampleFade"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <!-- Infographic Stats -->
      <h3 class="section-title">Infographic Stats</h3>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="info-card">
            <i class="fas fa-chart-line chart-icon"></i>
            <h4 class="fw-bold text-primary">Class Average</h4>
            <p>
              AVG: <strong>80%</strong> across all subjects this semester.
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-card">
            <i class="fas fa-user-graduate graduate-icon"></i>
            <h4 class="fw-bold text-primary">Top Performer</h4>
            <p>
              Name: <strong>Uweh Reuben</strong><br />GPA:
              <strong>4.90</strong>
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-card">
            <i class="fas fa-chart-bar bar-icon"></i>
            <h4 class="fw-bold text-primary">Performance Trend</h4>
            <p>Up: <strong>5%</strong> compared to last semester!</p>
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
</body>

</html>