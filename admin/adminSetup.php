<?php
// Admin setup script
session_start();
require "./config/database.php";

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
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="css/admin.css">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <button class="btn btn-outline-light me-3" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebar" aria-controls="sidebar">
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
                    <h1 class="h3 mb-0">Faculty & Department Setup</h1>
                    <p class="text-muted">Manage institutional structure and student levels</p>
                </div>
            </div>

            <!-- Setup Forms -->
            <div class="row">
                <!-- Add Faculty -->
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-university me-2"></i>Add New Faculty
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="addFacultyForm" method="post" action="./controller/faculty.php">
                                <div class="mb-3">
                                    <label for="facultyName" class="form-label">Faculty Name</label>
                                    <input type="text" class="form-control" id="facultyName" name="facultyName"
                                        placeholder="e.g., Faculty of Engineering" required>
                                    <div class="form-text">Enter the full name of the faculty</div>
                                </div>
                                <div class="mb-3">
                                    <label for="facultyCode" class="form-label">Faculty Code</label>
                                    <input type="text" class="form-control" id="facultyCode" name="facultyCode"
                                        placeholder="e.g., ENG" required>
                                    <div class="form-text">Short code for identification (3-4 characters)</div>
                                </div>
                                <div class="mb-3">
                                    <label for="facultyDescription" class="form-label">Description (Optional)</label>
                                    <textarea class="form-control" id="facultyDescription" name="facultyDescription"
                                        rows="3" placeholder="Brief description of the faculty"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add Faculty
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Add Department -->
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-building me-2"></i>Add New Department
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="addDepartmentForm" method="POST" action="./controller/departments.php">
                                <div class="mb-3">
                                    <label for="faculty_id" class="form-label">Select Faculty</label>
                                    <select class="form-select" id="faculty_id" name="facultyId" required>
                                        <option value="" selected disabled>Choose Faculty...</option>
                                        <?php foreach ($faculties as $faculty): ?>
                                            <option value="<?= $faculty['id'] ?>"><?= htmlspecialchars($faculty['facultyName']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="form-text">Select the parent faculty for this department</div>
                                </div>
                                <div class="mb-3">
                                    <label for="departmentName" class="form-label">Department Name</label>
                                    <input type="text" class="form-control" id="departmentName" name="departmentName"
                                        placeholder="e.g., Computer Science" required>
                                    <div class="form-text">Enter the full name of the department</div>
                                </div>
                                <div class="mb-3">
                                    <label for="departmentCode" class="form-label">Department Code</label>
                                    <input type="text" class="form-control" id="departmentCode" name="departmentCode"
                                        placeholder="e.g., CSC" required>
                                    <div class="form-text">Short code for identification (3-4 characters)</div>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-plus me-2"></i>Add Department
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Existing Faculties and Departments -->
            <div class="row">
                <!-- Faculties List -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Existing Faculties</h5>
                            <button class="btn btn-outline-primary btn-sm" onclick="refreshFaculties()">
                                <i class="fas fa-refresh me-1"></i>Refresh
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="faculty-list">
                                <?php if (empty($faculties)): ?>
                                    <div class="alert alert-info">No faculties found. Please add one.</div>
                                <?php else: ?>
                                    <?php foreach ($faculties as $faculty): ?>
                                        <div class="faculty-item border-bottom py-3">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1"><?= htmlspecialchars($faculty['facultyName']) ?></h6>
                                                    <p class="text-muted mb-0">Code: <?= htmlspecialchars($faculty['facultyCode']) ?></p>
                                                    <?php
                                                    $facultyId = $faculty['id'];
                                                    $deptQuery = $conn->query("SELECT COUNT(*) AS deptCount FROM departments WHERE facultyId = $facultyId");
                                                    $deptCount = 0;
                                                    if ($deptQuery && $deptQuery->num_rows > 0) {
                                                        $deptRow = $deptQuery->fetch_assoc();
                                                        $deptCount = $deptRow['deptCount'];
                                                    }
                                                    ?>
                                                    <small class="text-success">
                                                        Departments: <?= $deptCount ?>
                                                    </small>

                                                </div>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-warning" title="Edit" onclick="editFaculty(<?= $faculty['id'] ?>)">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-outline-danger" title="Delete" onclick="deleteFaculty(<?= $faculty['id'] ?>)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Departments List -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Existing Departments</h5>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" onclick="refreshDepartments()">Refresh
                                    <i class="fas fa-refresh"></i>
                                </button>
                            </div>
                        </div>
                        <?php foreach ($departments as $dept): ?>
                            <div class="card-body">
                                <div class="department-list">
                                    <div class="department-item border-bottom py-3" data-id="<?= $dept['id'] ?>">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1"><?= htmlspecialchars($dept['departmentName']) ?></h6>
                                                <p class="text-muted mb-1">
                                                    <?= htmlspecialchars($dept['facultyName']) ?> • Code: <?= htmlspecialchars($dept['departmentCode']) ?>
                                                </p>
                                            </div>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-warning" title="Edit" onclick="editDepartment(<?= $dept['id'] ?>)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-outline-danger" title="Delete" onclick="deleteDepartment(<?= $dept['id'] ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Setup Statistics</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="stat-item">
                                        <i class="fas fa-university fa-2x text-primary mb-2"></i>
                                        <h4>3</h4>
                                        <p class="text-muted">Total Faculties</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-item">
                                        <i class="fas fa-building fa-2x text-success mb-2"></i>
                                        <h4>13</h4>
                                        <p class="text-muted">Total Departments</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-item">
                                        <i class="fas fa-layer-group fa-2x text-warning mb-2"></i>
                                        <h4>7</h4>
                                        <p class="text-muted">Available Levels</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-item">
                                        <i class="fas fa-users fa-2x text-info mb-2"></i>
                                        <h4>1,234</h4>
                                        <p class="text-muted">Registered Students</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/setup.js"></script>
</body>

</html>