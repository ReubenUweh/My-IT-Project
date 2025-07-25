<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ClassTrack | Upload Assignments</title>
  <link rel="stylesheet" href="/assets/css/index.css" />
  <link href="/assets/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
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
      <a href="#" class="login-button me-2">Login</a>
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

  <!-- Main Content -->
  <div class="container">
    <!-- Selection Card -->
    <div class="selection-card mb-3">
      <h4 class="section-title">
        <i class="fas fa-filter me-2"></i>Select Course Details
      </h4>
      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="faculty" class="form-label fw-semibold">Faculty</label>
          <select id="faculty" class="form-select">
            <option selected>Select Faculty</option>
            <option value="1">Faculty of Agriculture</option>
            <option value="2">Faculty of BMS</option>
            <option value="3">Faculty Of Computing</option>
            <option value="4">Faculty of Education</option>
            <option value="5">Faculty of Engineering</option>
            <option value="6">Faculty of Law</option>
            <option value="7">Faculty of Management Science</option>
            <option value="8">Faculty of Science</option>
            <option value="9">Faculty of Theatre Arts</option>
          </select>
        </div>
        <div class="col-md-4 mb-3">
          <label for="department" class="form-label fw-semibold">Department</label>
          <select id="department" class="form-select">
            <option selected>Select Department</option>
            <option value="1">Cyber Security</option>
            <option value="2">Computer Science</option>
            <option value="3">Information Communication Technology</option>
            <option value="4">Software Engineering</option>
          </select>
        </div>
        <div class="col-md-4 mb-3">
          <label for="course" class="form-label fw-semibold">Course</label>
          <select id="course" class="form-select">
            <option selected>Select Course</option>
            <option value="1">SEN301</option>
            <option value="2">SEN302</option>
            <option value="3">SEN303</option>
            <option value="4">SEN304</option>
            <option value="5">SEN305</option>
            <option value="6">CSC302</option>
            <option value="7">CSC305</option>
            <option value="8">CED301</option>
            <option value="9">CED311</option>
          </select>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Upload Section -->
      <div class="col-lg-8 mb-4">
        <form action="php/files.php" method="post" enctype="multipart/form-data">
          <div class="upload-section">
            <h4 class="section-title">
              <i class="fas fa-cloud-upload-alt me-2"></i>Upload Assignment
            </h4>

            <div class="mb-4">
              <label for="assignmentTitle" class="form-label fw-semibold">Assignment Title</label>
              <input type="text" class="form-control" id="assignmentTitle" placeholder="Enter assignment title" />
            </div>

            <div class="upload-box mb-4">
              <i class="fas fa-cloud-upload-alt upload-icon"></i>
              <div class="upload-text">Click to Upload File</div>
              <div class="upload-subtext">
                Drag and drop files here or click to browse
              </div>
              <div class="upload-subtext mt-2">
                Supported formats: PDF, DOCX, PPT (Max: 10MB)
              </div>
              <input type="file" name="fileUpload" accept=".pdf,.docx,.ppt,.pptx" />
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
            <i class="fas fa-history me-2" style="color: #4caf50"></i>Upload
            History
          </h5>

          <div class="history-item">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-semibold">Assignment.pdf</div>
                <small class="text-muted">SEN301 - 2 hours ago</small>
              </div>
              <button class="btn btn-success-custom btn-sm">
                <i class="fas fa-check me-1"></i>Submitted
              </button>
            </div>
          </div>

          <div class="history-item">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-semibold">Project_Report.docx</div>
                <small class="text-muted">CSC302 - 1 day ago</small>
              </div>
              <button class="btn btn-success-custom btn-sm">
                <i class="fas fa-check me-1"></i>Submitted
              </button>
            </div>
          </div>

          <div class="history-item">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-semibold">Presentation.pptx</div>
                <small class="text-muted">SEN303 - 3 days ago</small>
              </div>
              <button class="btn btn-success-custom btn-sm">
                <i class="fas fa-check me-1"></i>Submitted
              </button>
            </div>
          </div>
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
  <script src="/assets/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="/assets/js/index.js"></script>
</body>

</html>