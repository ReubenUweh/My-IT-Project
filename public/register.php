<?php
session_start();
require_once "../config/database.php";

//fetching departments and faculties
$db = new DataBase();
$conn = $db->conn;

// $departments = [];
// $stmtQuery = "SELECT departments.id, departments.departmentName, faculties.facultyName 
//                 FROM departments JOIN faculties ON departments.facultyId = faculties.id";
// $result = $conn->query($stmtQuery);
// if ($result) {
//     while ($row = $result->fetch_assoc()) {
//         $departments[] = $row;
//     }
// }

$faculties = [];
$res = $conn->query("SELECT id, facultyName FROM faculties");
while ($row = $res->fetch_assoc()) {
    $faculties[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Registration - ClassTrack</title>
    <link rel="stylesheet" href="/assets/css/login.css" />
    <link href="/assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
</head>

<body>
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="index.html">ClassTrack</a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                        ClassTrack
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="upload.html">Uploads</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="assignments.html">Assignments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="submissions.html">Submissions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="feedback.html">Feedbacks</a>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="login.html" class="login-button me-2">Login</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Registration Section -->
    <div class="container-fluid registration-container">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <!-- Image Section -->
                <div class="col-lg-6 slide-in-left">
                    <div class="image-section">
                        <img src="/assets/images/Education-rafiki.svg" alt="Student Registration"
                            class="registration-image d-none d-md-block" width="400px" />
                        <div class="image-content">
                            <h2>Join ClassTrack</h2>
                            <p>
                                Register to access your student dashboard and manage your
                                academic activities
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Registration Form Section -->
                <div class="col-lg-6 slide-in-right">
                    <div class="registration-card fade-in">
                        <div class="card-header">
                            <h3 class="registration-title">Student Registration</h3>
                            <p class="registration-subtitle">
                                Fill in your academic details to get started
                            </p>
                        </div>

                        <div class="form-container">
                            <!-- Show success/error messages -->
                            <?php if (isset($_SESSION['success'])): ?>
                                <div class="alert alert-success"><?php echo $_SESSION['success'];
                                                                    unset($_SESSION['success']); ?></div>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['error'];
                                                                unset($_SESSION['error']); ?></div>
                            <?php endif; ?>
                            <form method="post" action="/controller/registerController.php" id="registrationForm">
                                <div class="name-row">
                                    <div class="form-group">
                                        <label for="firstName" class="form-label">
                                            <i class="fas fa-user"></i>First Name
                                        </label>
                                        <input type="text" class="form-control" id="firstName" name="firstName"
                                            placeholder="Enter your first name" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="lastName" class="form-label">
                                            <i class="fas fa-user"></i>Last Name
                                        </label>
                                        <input type="text" class="form-control" id="lastName" name="lastName"
                                            placeholder="Enter your last name" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="matricNumber" class="form-label">
                                        <i class="fas fa-id-card"></i>Matric Number
                                    </label>
                                    <input type="text" class="form-control" id="matricNo" name="matricNo"
                                        placeholder="e.g. CMP/2023/001" required />
                                </div>
                                <div class="form-group">
                                    <label for="faculty" class="form-label">
                                        <i class="fas fa-university"></i>Faculty
                                    </label>
                                    <select class="form-select" id="faculty" name="faculty" required>
                                        <option value="" selected disabled>
                                            Select Faculty
                                        </option>
                                        <?php
                                        foreach ($faculties as $faculty) {
                                            echo "<option value=\"{$faculty['id']}\">{$faculty['facultyName']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="department" class="form-label">
                                        <i class="fas fa-graduation-cap"></i>Department
                                    </label>
                                    <select class="form-select" id="department" name="departmentId" required>
                                        <option value="" selected disabled>
                                            Select Department
                                        </option>
                                    </select>
                                </div>

                                <button type="submit" class="submit-button">
                                    <i class="fas fa-user-plus me-2"></i>Register Account
                                </button>

                                <div class="login-link">
                                    <p class="text-muted">
                                        Already have an account?
                                        <a href="login.php">Login here</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-primary text-white py-4 text-center">
        <p class="mb-1">© 2025 ClassTrack Portal. All rights reserved.</p>
        <p class="small">
            Developed by Reuben Uweh · Student Project · Dept. of Software
            Engineering
        </p>
    </footer>

    <!-- Scripts -->
    <script src="/assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/assets/js/login.js"></script>
    <script>
        document.getElementById("faculty").addEventListener("change", function() {
            const facultyId = this.value;
            const departmentSelect = document.getElementById("department");

            if (!facultyId) return;

            fetch("../assets/api/fetchDepartments.php?facultyId=" + facultyId)
                .then((response) => response.json())
                .then((data) => {
                    departmentSelect.innerHTML =
                        '<option value="" selected disabled>Select Department</option>';
                    data.forEach((dept) => {
                        departmentSelect.innerHTML += `<option value="${dept.id}">${dept.departmentName}</option>`;
                    });
                })
                .catch((err) => {
                    console.error("Error fetching departments:", err);
                });
        });
    </script>
</body>

</html>