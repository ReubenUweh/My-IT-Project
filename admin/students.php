<?php
require "../config/database.php";
session_start();

$db = new DataBase();
$conn = $db->conn;

$stmt = "SELECT s.id, s.firstName, s.lastName, s.matricNo, f.facultyName, d.departmentName
            FROM students s
            JOIN departments d ON s.departmentId = d.id
            JOIN faculties f ON d.facultyId = f.id";

$result = $conn->query($stmt);

$faculties = $conn->query("SELECT * FROM faculties");
$departments = $conn->query("SELECT * FROM departments");


?>
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
                <a class="nav-link" href="adminSubmission.php">
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
                    <h1 class="h3 mb-0">Student Management</h1>
                    <p class="text-muted">Manage all registered students</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                        <i class="fas fa-plus me-2"></i>Add New Student
                    </button>
                </div>
            </div>

            <!-- Filters -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Search Students</label>
                            <input type="text" class="form-control" placeholder="Name or Matric Number"
                                id="searchStudent">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Faculty</label>
                            <select class="form-select" id="filterFaculty">
                                <option value="">All Faculties</option>
                                <?php while ($f = $faculties->fetch_assoc()): ?>
                                    <option value="<?= htmlspecialchars($f['facultyName']) ?>"><?= htmlspecialchars($f['facultyName']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Department</label>
                            <select class="form-select" id="filterDepartment">
                                <option value="">All Departments</option>
                                <?php while ($d = $departments->fetch_assoc()): ?>
                                    <option value="<?= $d['id'] ?>" data-faculty="<?= $d['facultyId'] ?>">
                                        <?= htmlspecialchars($d['departmentName']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Students Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Students List</h5>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-download me-1"></i>Export
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-print me-1"></i>Print
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="studentsTable">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" class="form-check-input" id="selectAll">
                                    </th>
                                    <th>id</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Matric Number</th>
                                    <th>Faculty</th>
                                    <th>Department</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input"></td>
                                            <td><?= $row['id'] ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-2">
                                                        <i class="fas fa-user-circle fa-2x text-muted"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0"><?= htmlspecialchars($row['firstName']) ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><?= htmlspecialchars($row['lastName']) ?></h6>
                                            </td>
                                            <td><?= htmlspecialchars($row['matricNo']) ?></td>
                                            <td><?= htmlspecialchars($row['facultyName']) ?></td>
                                            <td><?= htmlspecialchars($row['departmentName']) ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-primary" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-outline-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-outline-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No students found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>

                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Students pagination">
                        <ul class="pagination pagination-sm justify-content-center mt-3">
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
    </main>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="addStudentForm">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Matric Number</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Faculty</label>
                                <select class="form-select" required>
                                    <option value="">Select Faculty</option>
                                    <option value="engineering">Engineering</option>
                                    <option value="science">Science</option>
                                    <option value="arts">Arts</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Department</label>
                                <select class="form-select" required>
                                    <option value="">Select Department</option>
                                    <option value="computer">Computer Science</option>
                                    <option value="mechanical">Mechanical Engineering</option>
                                    <option value="electrical">Electrical Engineering</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Level</label>
                                <select class="form-select" required>
                                    <option value="">Select Level</option>
                                    <option value="100">100 Level</option>
                                    <option value="200">200 Level</option>
                                    <option value="300">300 Level</option>
                                    <option value="400">400 Level</option>
                                    <option value="500">500 Level</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/assets/js/admin.js"></script>
    <script src="/assets/js/students.js"></script>
</body>

</html>