<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link href="/assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <!-- Sidebar Toggle -->
            <button class="btn btn-outline-light me-3" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebar" aria-controls="sidebar">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand fw-bold" href="dashboard.html">
                <i class="fas fa-graduation-cap me-2"></i>Student Portal
            </a>

            <!-- Mobile menu toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Right side nav -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <!-- Search -->
                    <form class="d-flex me-3">
                        <input class="form-control" type="search" placeholder="Search..." aria-label="Search">
                        <button class="btn btn-outline-light ms-2" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    <!-- Notifications -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            <span class="badge bg-danger badge-notification">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <h6 class="dropdown-header">Notifications</h6>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-file-alt me-2"></i>New assignment
                                    submitted</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Student registered</a>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-clock me-2"></i>Deadline
                                    approaching</a></li>
                        </ul>
                    </div>

                    <!-- User Menu -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="settings.html"><i
                                        class="fas fa-cog me-2"></i>Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="offcanvas offcanvas-start sidebar-nav" tabindex="-1" id="sidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-primary">
                <i class="fas fa-graduation-cap me-2"></i>Student Portal
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <nav class="nav flex-column">
                <a class="nav-link active" href="dashboard.php">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a class="nav-link" href="students.php">
                    <i class="fas fa-users me-2"></i>Students
                </a>
                <a class="nav-link" href="adminAssignment.php">
                    <i class="fas fa-book me-2"></i>Assignments
                </a>
                <a class="nav-link" href="adminFeedback.php">
                    <i class="fas fa-comments me-2"></i>Feedback
                </a>
                <a class="nav-link" href="adminSetup.php">
                    <i class="fas fa-university me-2"></i>Faculty & Department Setup
                </a>
                <a class="nav-link" href="settings.php">
                    <i class="fas fa-cog me-2"></i>Settings
                </a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col">
                    <h1 class="h3 mb-0">Feedback & Review Center</h1>
                    <p class="text-muted">Review assignments and provide feedback to students</p>
                </div>
            </div>

            <!-- Feedback Statistics -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-file-alt fa-2x text-primary mb-2"></i>
                            <h4>156</h4>
                            <p class="text-muted mb-0">Total Submissions</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                            <h4>23</h4>
                            <p class="text-muted mb-0">Pending Review</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                            <h4>128</h4>
                            <p class="text-muted mb-0">Reviewed</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-exclamation-triangle fa-2x text-danger mb-2"></i>
                            <h4>5</h4>
                            <p class="text-muted mb-0">Flagged Issues</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Assignment</label>
                            <select class="form-select">
                                <option value="">All Assignments</option>
                                <option value="data-structures">Data Structures</option>
                                <option value="web-development">Web Development</option>
                                <option value="machine-learning">Machine Learning</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Faculty</label>
                            <select class="form-select">
                                <option value="">All Faculties</option>
                                <option value="engineering">Engineering</option>
                                <option value="science">Science</option>
                                <option value="arts">Arts</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option value="">All Status</option>
                                <option value="pending">Pending Review</option>
                                <option value="reviewed">Reviewed</option>
                                <option value="flagged">Flagged</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Priority</label>
                            <select class="form-select">
                                <option value="">All Priorities</option>
                                <option value="high">High Priority</option>
                                <option value="medium">Medium Priority</option>
                                <option value="low">Low Priority</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submissions List -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Recent Submissions</h5>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-download me-1"></i>Download All
                                </button>
                                <button type="button" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-check me-1"></i>Bulk Review
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <!-- Submission Item -->
                            <div class="submission-item border-bottom p-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center mb-2">
                                            <h6 class="mb-0 me-3">John Doe - Data Structures Assignment</h6>
                                            <span class="badge bg-warning">Pending Review</span>
                                        </div>
                                        <p class="text-muted mb-2">CS/2023/001 • Computer Science • 300 Level</p>
                                        <div class="d-flex align-items-center gap-3">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>Submitted: Dec 18, 2024
                                            </small>
                                            <small class="text-muted">
                                                <i class="fas fa-file-pdf me-1"></i>assignment.pdf (2.3 MB)
                                            </small>
                                            <small class="text-success">
                                                <i class="fas fa-clock me-1"></i>On Time
                                            </small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary" title="Preview"
                                                data-bs-toggle="modal" data-bs-target="#previewModal">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-success" title="Provide Feedback"
                                                data-bs-toggle="modal" data-bs-target="#feedbackModal">
                                                <i class="fas fa-comment"></i>
                                            </button>
                                            <button class="btn btn-outline-info" title="Download">
                                                <i class="fas fa-download"></i>
                                            </button>
                                            <button class="btn btn-outline-warning" title="Flag">
                                                <i class="fas fa-flag"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submission Item -->
                            <div class="submission-item border-bottom p-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center mb-2">
                                            <h6 class="mb-0 me-3">Jane Smith - Web Development Project</h6>
                                            <span class="badge bg-success">Reviewed</span>
                                        </div>
                                        <p class="text-muted mb-2">ME/2022/045 • Computer Science • 400 Level</p>
                                        <div class="d-flex align-items-center gap-3">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>Submitted: Dec 17, 2024
                                            </small>
                                            <small class="text-muted">
                                                <i class="fas fa-file-archive me-1"></i>project.zip (15.2 MB)
                                            </small>
                                            <small class="text-warning">
                                                <i class="fas fa-clock me-1"></i>Late (1 day)
                                            </small>
                                        </div>
                                        <div class="mt-2">
                                            <div class="d-flex align-items-center">
                                                <span class="text-muted me-2">Score:</span>
                                                <div class="rating">
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="far fa-star text-muted"></i>
                                                </div>
                                                <span class="ms-2 fw-bold">85/100</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary" title="Preview">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-success" title="Edit Feedback">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-outline-info" title="Download">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submission Item -->
                            <div class="submission-item p-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center mb-2">
                                            <h6 class="mb-0 me-3">Mike Johnson - Machine Learning Report</h6>
                                            <span class="badge bg-danger">Flagged</span>
                                        </div>
                                        <p class="text-muted mb-2">EE/2021/078 • Computer Science • 500 Level</p>
                                        <div class="d-flex align-items-center gap-3">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>Submitted: Dec 16, 2024
                                            </small>
                                            <small class="text-muted">
                                                <i class="fas fa-file-alt me-1"></i>report.docx (5.8 MB)
                                            </small>
                                            <small class="text-danger">
                                                <i class="fas fa-exclamation-triangle me-1"></i>Plagiarism Alert
                                            </small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary" title="Preview">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-danger" title="Review Flag">
                                                <i class="fas fa-flag"></i>
                                            </button>
                                            <button class="btn btn-outline-info" title="Download">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Review Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h2 class="text-primary">85%</h2>
                                <p class="text-muted">Average Score</p>
                            </div>

                            <div class="grade-distribution">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>A (90-100)</span>
                                    <span>25%</span>
                                </div>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-success" style="width: 25%"></div>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>B (80-89)</span>
                                    <span>45%</span>
                                </div>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-primary" style="width: 45%"></div>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>C (70-79)</span>
                                    <span>20%</span>
                                </div>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-warning" style="width: 20%"></div>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>D (60-69)</span>
                                    <span>8%</span>
                                </div>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-orange" style="width: 8%"></div>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>F (0-59)</span>
                                    <span>2%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width: 2%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-download me-2"></i>Export Grades
                                </button>
                                <button class="btn btn-outline-success">
                                    <i class="fas fa-email me-2"></i>Send Feedback Emails
                                </button>
                                <button class="btn btn-outline-warning">
                                    <i class="fas fa-chart-bar me-2"></i>Generate Report
                                </button>
                                <button class="btn btn-outline-info">
                                    <i class="fas fa-cog me-2"></i>Review Settings
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Feedback Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Provide Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="feedbackForm">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <h6>Student: John Doe - CS/2023/001</h6>
                                <p class="text-muted">Assignment: Data Structures and Algorithms</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Score</label>
                                <input type="number" class="form-control" min="0" max="100" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Grade</label>
                                <select class="form-select" required>
                                    <option value="">Select Grade</option>
                                    <option value="A">A (90-100)</option>
                                    <option value="B">B (80-89)</option>
                                    <option value="C">C (70-79)</option>
                                    <option value="D">D (60-69)</option>
                                    <option value="F">F (0-59)</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Comments</label>
                                <textarea class="form-control" rows="5"
                                    placeholder="Provide detailed feedback..."></textarea>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="emailStudent">
                                    <label class="form-check-label" for="emailStudent">
                                        Email feedback to student
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/assets/js/admin.js"></script>
    <script src="/assets/js/feedback.js"></script>
</body>

</html>