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
            <button class="btn btn-outline-light me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand fw-bold" href="dashboard.html">
                <i class="fas fa-graduation-cap me-2"></i>Student Portal
            </a>
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
        - <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col">
                    <h1 class="h3 mb-0">Dashboard</h1>
                    <p class="text-muted">Welcome to your student portal dashboard</p>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-primary">
                                    <i class="fas fa-users text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="text-muted mb-1">Total Students</h6>
                                    <h3 class="mb-0" id="totalStudents">1,234</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-success">
                                    <i class="fas fa-book text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="text-muted mb-1">Total Assignments</h6>
                                    <h3 class="mb-0" id="totalAssignments">87</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-warning">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="text-muted mb-1">Pending Feedback</h6>
                                    <h3 class="mb-0" id="pendingFeedback">23</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-info">
                                    <i class="fas fa-university text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="text-muted mb-1">Active Faculties</h6>
                                    <h3 class="mb-0" id="activeFaculties">12</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Recent Activity</h5>
                        </div>
                        <div class="card-body">
                            <div class="activity-item">
                                <div class="activity-icon bg-primary">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="activity-content">
                                    <p class="mb-1"><strong>John Doe</strong> registered as a new student</p>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon bg-success">
                                    <i class="fas fa-file-upload"></i>
                                </div>
                                <div class="activity-content">
                                    <p class="mb-1">New assignment <strong>"Data Structures"</strong> was created</p>
                                    <small class="text-muted">5 hours ago</small>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon bg-warning">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="activity-content">
                                    <p class="mb-1">Assignment deadline approaching for <strong>"Web Development"</strong></p>
                                    <small class="text-muted">1 day ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="students.php" class="btn btn-outline-primary">
                                    <i class="fas fa-user-plus me-2"></i>Add New Student
                                </a>
                                <a href="adminAssignment.php" class="btn btn-outline-success">
                                    <i class="fas fa-book me-2"></i>Create Assignment
                                </a>
                                <a href="adminSetup.php" class="btn btn-outline-info">
                                    <i class="fas fa-university me-2"></i>Manage Faculties
                                </a>
                                <a href="adminFeedback.php" class="btn btn-outline-warning">
                                    <i class="fas fa-comments me-2"></i>Review Feedback
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="/assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/assets/js/admin.js"></script>
</body>

</html>