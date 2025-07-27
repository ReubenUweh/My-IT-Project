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
          aria-labelledby="offcanvasNavbarLabel"
        >
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
              ClassTrack
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="offcanvas"
              aria-label="Close"
            ></button>
          </div>
           <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php"
                  >Home</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="uploads.php">Uploads</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="assignments.php"
                  >Assignments</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="submissions.php"
                  >Submissions</a
                >
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
          aria-label="Toggle navigation"
        >
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
        <div class="col-md-3 mb-3">
          <div class="stats-card">
            <div class="stats-number">12</div>
            <div class="stats-label">
              <i class="fas fa-check-circle me-1"></i>
              Total Submissions
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="stats-card">
            <div class="stats-number">8</div>
            <div class="stats-label">
              <i class="fas fa-star me-1"></i>
              Graded
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="stats-card">
            <div class="stats-number">3</div>
            <div class="stats-label">
              <i class="fas fa-hourglass-half me-1"></i>
              Under Review
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="stats-card">
            <div class="stats-number">1</div>
            <div class="stats-label">
              <i class="fas fa-clock me-1"></i>
              Late Submissions
            </div>
          </div>
        </div>
      </div>

      <!-- Filter Card -->
      <div class="filter-card mb-3">
        <h5 class="section-title">
          <i class="fas fa-filter me-2"></i>Filter Submissions
        </h5>
        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="semester" class="form-label fw-semibold"
              >Semester</label
            >
            <select id="semester" class="form-select">
              <option selected>All Semesters</option>
              <option value="1">2024/2025 - First</option>
              <option value="2">2024/2025 - Second</option>
              <option value="3">2023/2024 - Second</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <label for="course" class="form-label fw-semibold">Course</label>
            <select id="course" class="form-select">
              <option selected>All Courses</option>
              <option value="1">SEN301</option>
              <option value="2">SEN302</option>
              <option value="3">SEN303</option>
              <option value="4">CSC302</option>
              <option value="5">CSC305</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <label for="status" class="form-label fw-semibold">Status</label>
            <select id="status" class="form-select">
              <option selected>All Status</option>
              <option value="1">Submitted</option>
              <option value="2">Under Review</option>
              <option value="3">Graded</option>
              <option value="4">Late</option>
            </select>
          </div>
          <div class="col-md-3 mb-3 d-flex align-items-end">
            <button class="btn btn-filter w-100">
              <i class="fas fa-search me-2"></i>Apply Filter
            </button>
          </div>
        </div>
      </div>

      <!-- Submissions List -->
      <div class="submissions-container">
        <h4 class="section-title">
          <i class="fas fa-list me-2"></i>Submission History
        </h4>

        <div class="submission-card">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="course-code">CSC 305</div>
            <div class="status-badge">
              <i class="fas fa-check-circle"></i>
              Submitted
            </div>
          </div>
          <div class="submission-date">
            <i class="fas fa-calendar me-1"></i>
            Submitted on May 31st, 2024 at 11:45 PM
          </div>
          <div class="submission-description">
            Database Management Systems - Final Project: Design and implement a
            comprehensive database system for a library management application
            with advanced query optimization.
          </div>
          <div class="mt-3">
            <span class="badge bg-primary me-2">
              <i class="fas fa-file-pdf me-1"></i>
              Project_Report.pdf
            </span>
            <span class="badge bg-secondary">
              <i class="fas fa-code me-1"></i>
              Source_Code.zip
            </span>
          </div>
        </div>

        <div class="submission-card">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="course-code">SEN 302</div>
            <div
              class="status-badge"
              style="
                background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
              "
            >
              <i class="fas fa-hourglass-half"></i>
              Under Review
            </div>
          </div>
          <div class="submission-date">
            <i class="fas fa-calendar me-1"></i>
            Submitted on May 19th, 2024 at 2:30 PM
          </div>
          <div class="submission-description">
            Software Testing and Quality Assurance - Assignment 3: Develop
            comprehensive test cases and perform automated testing for a web
            application using modern testing frameworks.
          </div>
          <div class="mt-3">
            <span class="badge bg-primary me-2">
              <i class="fas fa-file-word me-1"></i>
              Test_Cases.docx
            </span>
            <span class="badge bg-secondary">
              <i class="fas fa-video me-1"></i>
              Demo_Video.mp4
            </span>
          </div>
        </div>

        <div class="submission-card">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="course-code">SEN 301</div>
            <div
              class="status-badge"
              style="
                background: linear-gradient(135deg, #9c27b0 0%, #7b1fa2 100%);
              "
            >
              <i class="fas fa-star"></i>
              Graded - A
            </div>
          </div>
          <div class="submission-date">
            <i class="fas fa-calendar me-1"></i>
            Submitted on May 12th, 2024 at 8:15 AM
          </div>
          <div class="submission-description">
            Software Engineering Principles - Mid-term Project: Analysis and
            design of a complete software development lifecycle for an
            e-commerce platform with UML diagrams.
          </div>
          <div class="mt-3">
            <span class="badge bg-primary me-2">
              <i class="fas fa-file-powerpoint me-1"></i>
              Presentation.pptx
            </span>
            <span class="badge bg-success">
              <i class="fas fa-medal me-1"></i>
              Grade: 85/100
            </span>
          </div>
        </div>

        <div class="submission-card">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="course-code">SEN 303</div>
            <div class="status-badge">
              <i class="fas fa-check-circle"></i>
              Submitted
            </div>
          </div>
          <div class="submission-date">
            <i class="fas fa-calendar me-1"></i>
            Submitted on May 10th, 2024 at 6:20 PM
          </div>
          <div class="submission-description">
            Web Development Technologies - Assignment 2: Create a responsive web
            application using modern JavaScript frameworks with RESTful API
            integration and user authentication.
          </div>
          <div class="mt-3">
            <span class="badge bg-primary me-2">
              <i class="fas fa-code me-1"></i>
              WebApp_Code.zip
            </span>
            <span class="badge bg-secondary">
              <i class="fas fa-link me-1"></i>
              Live_Demo_Link
            </span>
          </div>
        </div>

        <div class="submission-card">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="course-code">CSC 302</div>
            <div
              class="status-badge"
              style="
                background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
              "
            >
              <i class="fas fa-exclamation-triangle"></i>
              Late Submission
            </div>
          </div>
          <div class="submission-date">
            <i class="fas fa-calendar me-1"></i>
            Submitted on May 7th, 2024 at 11:59 PM (2 days late)
          </div>
          <div class="submission-description">
            Data Structures and Algorithms - Assignment 1: Implement and analyze
            various sorting algorithms with time complexity comparison and
            performance benchmarking.
          </div>
          <div class="mt-3">
            <span class="badge bg-primary me-2">
              <i class="fas fa-file-code me-1"></i>
              Algorithms.cpp
            </span>
            <span class="badge bg-warning text-dark">
              <i class="fas fa-clock me-1"></i>
              Penalty Applied
            </span>
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
  <script src="/assets/bootstrap/js/bootstrap.bundle.js"></script>
  </body>
</html>
