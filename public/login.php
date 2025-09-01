<?php
require_once "../config/database.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Login - ClassTrack</title>
    <link rel="stylesheet" href="../assets/css/login.css" />
    <link href="../assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>

<body>
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="./login.php">ClassTrack</a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                        ClassTrack
                    </h5>
                </div>
            </div>
        </div>
    </nav>

    <!-- Login Section -->
    <div class="container-fluid login-container">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <!-- Image Section -->
                <div class="col-lg-6 mb-4 slide-in-left">
                    <div class="image-section">
                        <img src="../assets/images/Education-rafiki.svg" alt="Student Login"
                            class="login-image d-none d-md-block" />
                        <div class="image-content">
                            <h2>Welcome Back</h2>
                            <p>
                                Sign in to access your student dashboard and continue your
                                academic journey
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Login Form Section -->
                <div class="col-lg-6 slide-in-right">
                    <div class="login-card fade-in">
                        <div class="card-header">
                            <h3 class="login-title">Student Login</h3>
                            <p class="login-subtitle">Access your academic portal</p>
                        </div>

                        <div class="form-container">
                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['error'];
                                                                unset($_SESSION['error']); ?></div>
                            <?php endif; ?>
                            <form method="post" action="../controller/loginController.php" id="loginForm">
                                <div class="form-group">
                                    <label for="lastName" class="form-label">
                                        <i class="fas fa-id-card"></i>Last Name
                                    </label>
                                    <input type="text" class="form-control" id="lastName" name="lastName"
                                        placeholder="Enter your last name" required />
                                </div>

                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock"></i>Matric Number
                                    </label>
                                    <div style="position: relative">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter your matric Number" required />
                                        <button type="button" class="password-toggle" onclick="togglePassword()">
                                            <i class="fas fa-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe" />
                                    <label class="form-check-label" for="rememberMe">
                                        Remember me
                                    </label>
                                </div>

                                <button type="submit" class="submit-button">
                                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                                </button>

                                <div class="forgot-password">
                                    <a href="#"
                                        onclick="alert('Please contact your administrator to reset your password.')">
                                        Forgot your password?
                                    </a>
                                </div>

                                <div class="register-link">
                                    <p class="text-muted">
                                        Don't have an account?
                                        <a href="register.php">Register here</a>
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
    <script src="../assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/login.js"></script>
</body>

</html>