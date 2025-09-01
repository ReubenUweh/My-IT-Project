<?php
require "../config/database.php";

$db = new DataBase();
$conn = $db->conn;

//fetch all faculties from database
$faculties = [];
$result = $conn->query("SELECT * FROM faculties ORDER BY facultyName");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $faculties[] = $row;
    }
}

//department
$departments = $conn->query("SELECT d.*, f.facultyName FROM departments d JOIN faculties f ON d.facultyId = f.id ORDER BY d.departmentName");
if (!$departments) {
    $_SESSION['error'] = "Failed to fetch departments: " . $conn->error;
    header("Location: adminSetup.php");
    exit();
}

$query = "SELECT a.id, a.assignmentTitle, a.assignmentDescription, a.endDate, a.startDate, 
                 a.allowedFileTypes, d.departmentName 
          FROM assignments a 
          JOIN departments d ON a.departmentId = d.id 
          ORDER BY a.create_time DESC 
          LIMIT 4";

$assignmentsResult = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link href="../assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <!-- Sidebar Toggle -->
            <button class="btn btn-outline-light me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand fw-bold" href="index.html">
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
                            <li><a class="dropdown-item" href="#"><i class="fas fa-file-alt me-2"></i>New assignment submitted</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Student registered</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-clock me-2"></i>Deadline approaching</a></li>
                        </ul>
                    </div>

                    <!-- User Menu -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="settings.html"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
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

    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h1 class="h3 mb-0">Assignment Center</h1>
                    <p class="text-muted">Create and manage course assignments</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAssignmentModal">
                        <i class="fas fa-plus me-2"></i>Create New Assignment
                    </button>
                </div>
            </div>

            <!-- Assignment Statistics -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-book fa-2x text-primary mb-2"></i>
                            <h4>87</h4>
                            <p class="text-muted mb-0">Total Assignments</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-hourglass-half fa-2x text-warning mb-2"></i>
                            <h4>23</h4>
                            <p class="text-muted mb-0">Active Assignments</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                            <h4>64</h4>
                            <p class="text-muted mb-0">Completed</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-exclamation-triangle fa-2x text-danger mb-2"></i>
                            <h4>5</h4>
                            <p class="text-muted mb-0">Overdue</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Search Assignments</label>
                            <input type="text" class="form-control" placeholder="Assignment title or course">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Faculty</label>
                            <select class="form-select">
                                <option value="">All Faculties</option>
                                <?php foreach ($faculties as $faculty): ?>
                                    <option value="<?= $faculty['id'] ?>"><?= htmlspecialchars($faculty['facultyName']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Department</label>
                            <select class="form-select">
                                <option value="">All Departments</option>
                                <option value="computer">Computer Science</option>
                                <option value="mechanical">Mechanical Engineering</option>
                                <option value="electrical">Electrical Engineering</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="completed">Completed</option>
                                <option value="overdue">Overdue</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <button class="btn btn-outline-primary w-100">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($assignmentsResult->num_rows > 0): ?>
                <div class="row">
                    <?php while ($row = $assignmentsResult->fetch_assoc()): ?>
                        <div class="col-md-6 mb-4">
                            <div class="assignment-card p-3 shadow-sm rounded border bg-white">
                                <div class="priority-badge priority-high">New</div>
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="course-code text-primary"><?= htmlspecialchars($row['departmentName']) ?></div>
                                    <div class="status-badge status-pending">
                                        <i class="fas fa-hourglass-half"></i> Active
                                    </div>
                                </div>
                                <div class="assignment-date text-muted mb-2">
                                    <i class="fas fa-calendar me-1"></i>
                                    Start: <?= date('M d, Y', strtotime($row['startDate'])) ?> |
                                    End: <?= date('M d, Y', strtotime($row['endDate'])) ?>
                                </div>
                                <div class="assignment-description mb-2">
                                    <strong><?= htmlspecialchars($row['assignmentTitle']) ?>:</strong><br>
                                    <?= nl2br(htmlspecialchars($row['assignmentDescription'])) ?>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-file-alt me-1"></i>
                                        <?= htmlspecialchars($row['allowedFileTypes']) ?>
                                    </span>
                                    <a href="assignment-view.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-gradient">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">No recent assignments uploaded.</p>
            <?php endif; ?>


            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Assignment Progress</h5>
                    </div>
                    <div class="card-body">
                        <div class="progress-item mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Data Structures</span>
                                <span>75%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-success" style="width: 75%"></div>
                            </div>
                        </div>

                        <div class="progress-item mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Web Development</span>
                                <span>60%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" style="width: 60%"></div>
                            </div>
                        </div>

                        <div class="progress-item mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Machine Learning</span>
                                <span>40%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width: 40%"></div>
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
                                <i class="fas fa-download me-2"></i>Export All Assignments
                            </button>
                            <button class="btn btn-outline-success">
                                <i class="fas fa-bell me-2"></i>Send Reminders
                            </button>
                            <button class="btn btn-outline-info">
                                <i class="fas fa-chart-bar me-2"></i>View Analytics
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

    <!-- Create Assignment Modal -->
    <div class="modal fade" id="createAssignmentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Assignment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="createAssignmentForm" action="../controller/adminUpload.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Assignment Title</label>
                                <input type="text" class="form-control" name="assignmentTitle" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="3" name="assignmentDescription" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Faculty</label>
                                <select class="form-select" required>
                                    <option value="">Select Faculty</option>
                                    <?php foreach ($faculties as $faculty): ?>
                                        <option value="<?= $faculty['id'] ?>"><?= htmlspecialchars($faculty['facultyName']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Department</label>
                                <select class="form-select" name="departmentId" required>
                                    <option value="">Select Department</option>
                                    <?php foreach ($departments as $dept): ?>
                                        <option value="<?= $dept['id'] ?>"><?= htmlspecialchars($dept['departmentName']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Start Date</label>
                                <input type="datetime-local" class="form-control" name="startDate" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Due Date</label>
                                <input type="datetime-local" class="form-control" name="endDate" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Allowed File Types</label>
                                <div class="form-check-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="allowedFileTypes[]" value="pdf" id="pdf">
                                        <label class="form-check-label" for="pdf">PDF</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="allowedFileTypes[]" value="docx" id="docx">
                                        <label class="form-check-label" for="docx">DOCX</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="allowedFileTypes[]" value="txt" id="txt">
                                        <label class="form-check-label" for="txt">TXT</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="allowedFileTypes[]" value="ppt" id="ppt">
                                        <label class="form-check-label" for="ppt">PPT</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Assignment Files (Optional)</label>
                                <input type="file" class="form-control" name="fileUpload">
                                <small class="text-muted">Upload reference materials or instructions</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Assignment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/admin.js"></script>
    <script src="../assets/js/assignment.js"></script>
</body>

</html>