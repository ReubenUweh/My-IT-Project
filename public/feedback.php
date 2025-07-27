<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ClassTrack Feedback Portal</title>
  <link rel="stylesheet" href="/assets/css/index.css" />
  <link href="/assets/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
</head>

<body>
  <!-- NavBar -->
  <nav class="navbar bg-body-secondary navbar-expand-lg fixed-top">
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
  <!-- End of NavBar -->
  <!-- Toast Container -->
  <div class="toast-container">
    <div id="successToast" class="toast" role="alert">
      <div class="toast-header">
        <i class="fas fa-check-circle text-success me-2"></i>
        <strong class="me-auto">Success</strong>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="toast"></button>
      </div>
      <div class="toast-body">Feedback submitted successfully!</div>
    </div>
  </div>

  <!-- Header -->
  <div class="container text-center top">
    <p class="lead fw-bolder">
      Share your thoughts and help improve the learning experience. Your
      feedback matters!
    </p>
  </div>

  <div class="container">
    <!-- Stats Cards -->
    <div class="row mb-4">
      <div class="col-md-4 mb-3">
        <div class="card stat-card h-100">
          <div
            class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h6 class="text-muted">Total Feedbacks</h6>
              <h2 class="text-primary fw-bold mb-0" id="totalFeedbacks">3</h2>
            </div>
            <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
              <i class="fas fa-comments text-primary fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card stat-card h-100">
          <div
            class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h6 class="text-muted">Average Rating</h6>
              <h2 class="text-success fw-bold mb-0" id="avgRating">4.7</h2>
            </div>
            <div class="bg-success bg-opacity-10 p-3 rounded-circle">
              <i class="fas fa-chart-line text-success fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card stat-card h-100">
          <div
            class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h6 class="text-muted">This Week</h6>
              <h2 class="text-warning fw-bold mb-0" id="weeklyFeedbacks">
                2
              </h2>
            </div>
            <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
              <i class="fas fa-calendar-week text-warning fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabs -->
    <div class="text-center mb-4">
      <button class="btn tab-btn active" onclick="showTab('submit')">
        <i class="fas fa-paper-plane me-2"></i>Submit Feedback
      </button>
      <button class="btn tab-btn" onclick="showTab('view')">
        <i class="fas fa-eye me-2"></i>Recent Feedbacks
      </button>
    </div>

    <!-- Submit Feedback Tab -->
    <div id="submitTab" class="tab-content">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="feedback-form">
            <div class="form-header">
              <h3 class="mb-0">
                <i class="fas fa-paper-plane me-2"></i>Submit Feedback
              </h3>
            </div>
            <div class="p-4">
              <form id="feedbackForm" method="post">
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label class="form-label">Student Name (Optional)</label>
                    <input
                      type="text"
                      class="form-control"
                      id="studentName"
                      placeholder="Your full name" />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Course *</label>
                    <input
                      type="text"
                      class="form-control"
                      id="course"
                      placeholder="e.g., Data Structures"
                      required />
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-6">
                    <label class="form-label">Lecturer Name *</label>
                    <input
                      type="text"
                      class="form-control"
                      id="lecturer"
                      placeholder="Lecturer's full name"
                      required />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Feedback Category *</label>
                    <select class="form-select" id="category" required>
                      <option value="">Select category</option>
                      <option value="teaching-style">Teaching Style</option>
                      <option value="course-content">Course Content</option>
                      <option value="assignments">Assignments</option>
                      <option value="communication">Communication</option>
                      <option value="resources">Learning Resources</option>
                      <option value="general">General Feedback</option>
                    </select>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Overall Rating *</label>
                  <div class="d-flex align-items-center">
                    <div id="starRating">
                      <i class="fas fa-star star-rating" data-rating="1"></i>
                      <i class="fas fa-star star-rating" data-rating="2"></i>
                      <i class="fas fa-star star-rating" data-rating="3"></i>
                      <i class="fas fa-star star-rating" data-rating="4"></i>
                      <i class="fas fa-star star-rating" data-rating="5"></i>
                    </div>
                    <span class="ms-3 text-muted" id="ratingText"></span>
                  </div>
                  <input type="hidden" id="rating" required />
                </div>

                <div class="mb-3">
                  <label class="form-label">Your Feedback *</label>
                  <textarea
                    class="form-control"
                    id="message"
                    rows="6"
                    placeholder="Share your thoughts, suggestions, or concerns..."
                    required></textarea>
                </div>

                <div class="form-check mb-4">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="anonymous" />
                  <label class="form-check-label" for="anonymous">
                    Submit anonymously
                  </label>
                </div>

                <button
                  type="submit"
                  id="submit"
                  class="btn btn-primary btn-submit w-100">
                  <i class="fas fa-paper-plane me-2"></i>Submit Feedback
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- View Feedbacks Tab -->
    <div id="viewTab" class="tab-content" style="display: none">
      <div class="text-center mb-4">
        <h2 class="fw-bold">Recent Feedback Submissions</h2>
        <p class="text-muted">See what your fellow students are saying</p>
      </div>
      <div id="feedbackList"></div>
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
  <script src="/assets/js/index.js"></script>
</body>

</html>