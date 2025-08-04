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
                <a href="adminSubmission.php" class="nav-link">
                    <i class="fas fa-file-upload me-2"></i>Submissions
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

    <!-- Submissions Content -->
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3">Submissions Management</h1>
                    <div class="btn-group">
                        <button class="btn btn-outline-primary" id="downloadSelectedBtn" disabled>
                            <i class="fas fa-download"></i> Download Selected
                        </button>
                        <button class="btn btn-outline-success" id="downloadAllBtn">
                            <i class="fas fa-download"></i> Download All
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="row mb-4">
            <div class="col-md-3">
                <select class="form-select" id="assignmentFilter">
                    <option value="">All Assignments</option>
                    <option value="data-structures">Data Structures Project</option>
                    <option value="calculus">Calculus Problem Set</option>
                    <option value="circuit-design">Circuit Design Lab</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" id="statusFilter">
                    <option value="">All Status</option>
                    <option value="submitted">Submitted</option>
                    <option value="graded">Graded</option>
                    <option value="returned">Returned</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" id="plagiarismFilter">
                    <option value="">All</option>
                    <option value="flagged">Plagiarism Flagged</option>
                    <option value="clear">Clear</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" class="form-control" id="submissionDate">
            </div>
            <div class="col-md-3">
                <input type="search" class="form-control" id="submissionSearch"
                    placeholder="Search submissions...">
            </div>
        </div>

        <!-- Submissions Table -->
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="submissionsTable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAllSubmissions"></th>
                                <th>Student</th>
                                <th>Assignment</th>
                                <th>Submitted</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Score</th>
                                <th>Plagiarism</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" class="submission-checkbox"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/32x32" class="rounded-circle me-2"
                                            alt="Avatar">
                                        <div>
                                            <div class="fw-bold">John Doe</div>
                                            <small class="text-muted">CS/2023/001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Data Structures Project</td>
                                <td>
                                    <div>Mar 10, 2024</div>
                                    <small class="text-muted">2:30 PM</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-pdf text-danger me-2"></i>
                                        <span>project_report.pdf</span>
                                    </div>
                                    <small class="text-muted">2.4 MB</small>
                                </td>
                                <td><span class="badge bg-warning">Grading</span></td>
                                <td>
                                    <div class="input-group input-group-sm" style="width: 80px;">
                                        <input type="number" class="form-control" value="85" max="100" min="0">
                                        <span class="input-group-text">/100</span>
                                    </div>
                                </td>
                                <td><span class="badge bg-success">Clear</span></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="View/Annotate"
                                            data-bs-toggle="modal" data-bs-target="#viewSubmissionModal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-success" title="Download">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="Feedback"
                                            onclick="window.location.href='feedback.html'">
                                            <i class="fas fa-comment"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="submission-checkbox"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/32x32" class="rounded-circle me-2"
                                            alt="Avatar">
                                        <div>
                                            <div class="fw-bold">Jane Smith</div>
                                            <small class="text-muted">ENG/2023/045</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Circuit Design Lab</td>
                                <td>
                                    <div>Mar 12, 2024</div>
                                    <small class="text-muted">4:15 PM</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-word text-primary me-2"></i>
                                        <span>circuit_analysis.docx</span>
                                    </div>
                                    <small class="text-muted">1.8 MB</small>
                                </td>
                                <td><span class="badge bg-success">Graded</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bold text-success">92/100</span>
                                    </div>
                                </td>
                                <td><span class="badge bg-danger">Flagged</span></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="View/Annotate">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-success" title="Download">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="Feedback">
                                            <i class="fas fa-comment"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="submission-checkbox"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/32x32" class="rounded-circle me-2"
                                            alt="Avatar">
                                        <div>
                                            <div class="fw-bold">Mike Johnson</div>
                                            <small class="text-muted">SCI/2023/078</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Calculus Problem Set</td>
                                <td>
                                    <div>Mar 11, 2024</div>
                                    <small class="text-muted">11:45 AM</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-pdf text-danger me-2"></i>
                                        <span>calculus_solutions.pdf</span>
                                    </div>
                                    <small class="text-muted">3.1 MB</small>
                                </td>
                                <td><span class="badge bg-info">Submitted</span></td>
                                <td>
                                    <div class="input-group input-group-sm" style="width: 80px;">
                                        <input type="number" class="form-control" placeholder="0" max="100"
                                            min="0">
                                        <span class="input-group-text">/100</span>
                                    </div>
                                </td>
                                <td><span class="badge bg-secondary">Pending</span></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="View/Annotate">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-success" title="Download">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="Feedback">
                                            <i class="fas fa-comment"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Submissions pagination">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- View Submission Modal -->
    <div class="modal fade" id="viewSubmissionModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Submission - John Doe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- PDF Viewer / Document Preview -->
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Document Preview</h6>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-secondary" id="zoomOut">
                                            <i class="fas fa-search-minus"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" id="zoomIn">
                                            <i class="fas fa-search-plus"></i>
                                        </button>
                                        <button class="btn btn-outline-primary" id="downloadDoc">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="height: 500px; overflow-y: auto;">
                                    <!-- This would contain the actual PDF viewer or document content -->
                                    <div class="text-center py-5">
                                        <i class="fas fa-file-pdf fa-4x text-muted mb-3"></i>
                                        <p class="text-muted">PDF Viewer would be integrated here</p>
                                        <p class="small text-muted">project_report.pdf (2.4 MB)</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Annotation Tools -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Annotation Tools</h6>
                                </div>
                                <div class="card-body">
                                    <div class="btn-group-vertical w-100" role="group">
                                        <button type="button" class="btn btn-outline-primary mb-2">
                                            <i class="fas fa-highlighter"></i> Highlight
                                        </button>
                                        <button type="button" class="btn btn-outline-warning mb-2">
                                            <i class="fas fa-sticky-note"></i> Add Note
                                        </button>
                                        <button type="button" class="btn btn-outline-danger mb-2">
                                            <i class="fas fa-times-circle"></i> Mark Error
                                        </button>
                                        <button type="button" class="btn btn-outline-success">
                                            <i class="fas fa-check-circle"></i> Mark Correct
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Grading Panel -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Grading</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Score</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" value="85" max="100" min="0">
                                            <span class="input-group-text">/100</span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Rubric</label>
                                        <div class="list-group list-group-flush">
                                            <div
                                                class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                <span>Content Quality</span>
                                                <input type="number" class="form-control form-control-sm"
                                                    style="width: 60px;" value="20" max="25">
                                                <small class="text-muted">/25</small>
                                            </div>
                                            <div
                                                class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                <span>Code Structure</span>
                                                <input type="number" class="form-control form-control-sm"
                                                    style="width: 60px;" value="18" max="25">
                                                <small class="text-muted">/25</small>
                                            </div>
                                            <div
                                                class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                <span>Documentation</span>
                                                <input type="number" class="form-control form-control-sm"
                                                    style="width: 60px;" value="22" max="25">
                                                <small class="text-muted">/25</small>
                                            </div>
                                            <div
                                                class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                <span>Testing</span>
                                                <input type="number" class="form-control form-control-sm"
                                                    style="width: 60px;" value="25" max="25">
                                                <small class="text-muted">/25</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Plagiarism Check -->
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Plagiarism Check</h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Similarity Score:</span>
                                        <span class="badge bg-success">8%</span>
                                    </div>
                                    <div class="progress mb-3" style="height: 8px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 8%"></div>
                                    </div>
                                    <button class="btn btn-outline-info btn-sm w-100">
                                        <i class="fas fa-search"></i> View Detailed Report
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning">Save Draft</button>
                    <button type="button" class="btn btn-success">Submit Grade</button>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/assets/js/admin.js"></script>
</body>

</html>