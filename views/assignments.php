<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ClassTrack | My Assignments</title>
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="/bootclass/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css" />
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
                <a class="nav-link active" aria-current="page" href="index.html"
                  >Home</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="uploads.html">Uploads</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="assignments.html"
                  >Assignments</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="submissions.html"
                  >Submissions</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link mx-lg-2" href="feedback.html">Feedbacks</a>
              </li>
            </ul>
          </div>
        </div>
        <a href="#" class="login-button me-2">Login</a>
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
            <div class="stats-number">8</div>
            <div class="stats-label">
              <i class="fas fa-tasks me-1"></i>
              Total Assignments
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="stats-card">
            <div class="stats-number">3</div>
            <div class="stats-label">
              <i class="fas fa-hourglass-half me-1"></i>
              Pending
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="stats-card">
            <div class="stats-number">4</div>
            <div class="stats-label">
              <i class="fas fa-check-circle me-1"></i>
              Completed
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="stats-card">
            <div class="stats-number">1</div>
            <div class="stats-label">
              <i class="fas fa-exclamation-triangle me-1"></i>
              Overdue
            </div>
          </div>
        </div>
      </div>

      <!-- Filter Card -->
      <div class="filter-card mb-4">
        <h5 class="section-title">
          <i class="fas fa-filter me-2"></i>Filter Assignments
        </h5>
        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="status" class="form-label fw-semibold">Status</label>
            <select id="status" class="form-select">
              <option selected>All Assignments</option>
              <option value="1">Pending</option>
              <option value="2">Completed</option>
              <option value="3">Overdue</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <label for="course" class="form-label fw-semibold">Course</label>
            <select id="course" class="form-select">
              <option selected>All Courses</option>
              <option value="1">SEN304</option>
              <option value="2">SEN301</option>
              <option value="3">CSC302</option>
              <option value="4">SEN303</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <label for="priority" class="form-label fw-semibold"
              >Priority</label
            >
            <select id="priority" class="form-select">
              <option selected>All Priorities</option>
              <option value="1">High</option>
              <option value="2">Medium</option>
              <option value="3">Low</option>
            </select>
          </div>
          <div class="col-md-3 mb-3 d-flex align-items-end">
            <button class="btn btn-filter w-100">
              <i class="fas fa-search me-2"></i>Apply Filter
            </button>
          </div>
        </div>
      </div>

      <!-- Assignments List -->
      <div class="assignments-container">
        <h4 class="section-title">
          <i class="fas fa-list me-2"></i>Assignment List
        </h4>

        <div class="assignment-card">
          <div class="priority-badge priority-high">High Priority</div>
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="course-code">SEN 304</div>
            <div class="status-badge status-pending">
              <i class="fas fa-hourglass-half"></i>
              Pending
            </div>
          </div>
          <div class="assignment-date">
            <i class="fas fa-calendar me-1"></i>
            Due: <span class="due-date">May 25, 2024</span> | End: May 30, 2024
          </div>
          <div class="assignment-description">
            Software Project Management - Complete project documentation
            including requirements analysis and system design
          </div>
          <div class="mt-3 d-flex justify-content-between align-items-center">
            <div>
              <span class="badge bg-primary me-2">
                <i class="fas fa-code me-1"></i>
                Programming
              </span>
              <span class="badge bg-secondary">
                <i class="fas fa-file-alt me-1"></i>
                Documentation
              </span>
            </div>
            <a href="#" class="btn-gradient">View Details</a>
          </div>
        </div>

        <div class="assignment-card">
          <div class="priority-badge priority-medium">Medium Priority</div>
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="course-code">SEN 301</div>
            <div class="status-badge status-submitted">
              <i class="fas fa-check-circle"></i>
              Submitted
            </div>
          </div>
          <div class="assignment-date">
            <i class="fas fa-calendar me-1"></i>
            Due: June 1, 2024 | End: June 5, 2024
          </div>
          <div class="assignment-description">
            Software Engineering Principles - Research paper on Agile
            methodologies and their implementation in modern software
            development
          </div>
          <div class="mt-3 d-flex justify-content-between align-items-center">
            <div>
              <span class="badge bg-info me-2">
                <i class="fas fa-book me-1"></i>
                Research
              </span>
              <span class="badge bg-success">
                <i class="fas fa-check me-1"></i>
                Completed
              </span>
            </div>
            <a href="#" class="btn-gradient">View Details</a>
          </div>
        </div>

        <div class="assignment-card">
          <div class="priority-badge priority-high">High Priority</div>
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="course-code">CSC 302</div>
            <div class="status-badge status-overdue">
              <i class="fas fa-exclamation-triangle"></i>
              Overdue
            </div>
          </div>
          <div class="assignment-date">
            <i class="fas fa-calendar me-1"></i>
            Due: <span class="due-date">May 20, 2024</span> | End: May 25, 2024
          </div>
          <div class="assignment-description">
            Database Systems - Design and implement a complete database system
            for a retail management application
          </div>
          <div class="mt-3 d-flex justify-content-between align-items-center">
            <div>
              <span class="badge bg-warning text-dark me-2">
                <i class="fas fa-database me-1"></i>
                Database
              </span>
              <span class="badge bg-danger">
                <i class="fas fa-clock me-1"></i>
                2 Days Late
              </span>
            </div>
            <a href="#" class="btn-gradient">View Details</a>
          </div>
        </div>

        <div class="assignment-card">
          <div class="priority-badge priority-low">Low Priority</div>
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="course-code">SEN 303</div>
            <div class="status-badge status-pending">
              <i class="fas fa-hourglass-half"></i>
              Pending
            </div>
          </div>
          <div class="assignment-date">
            <i class="fas fa-calendar me-1"></i>
            Due: June 10, 2024 | End: June 15, 2024
          </div>
          <div class="assignment-description">
            Web Development - Create a responsive web application using React
            and Node.js with full CRUD functionality
          </div>
          <div class="mt-3 d-flex justify-content-between align-items-center">
            <div>
              <span class="badge bg-primary me-2">
                <i class="fas fa-laptop-code me-1"></i>
                Web Dev
              </span>
              <span class="badge bg-info">
                <i class="fas fa-calendar-plus me-1"></i>
                2 Weeks Left
              </span>
            </div>
            <a href="#" class="btn-gradient">View Details</a>
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
    <script src="/bootclass/bootstrap/js/bootstrap.bundle.js"></script>
  </body>
</html>
