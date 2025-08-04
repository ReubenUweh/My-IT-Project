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
                <div class="col">
                    <h1 class="h3 mb-0">Settings</h1>
                    <p class="text-muted">Configure your student portal preferences</p>
                </div>
            </div>

            <div class="row">
                <!-- Settings Navigation -->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Settings Categories</h6>
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="#general" class="list-group-item list-group-item-action active"
                                data-bs-toggle="tab">
                                <i class="fas fa-cog me-2"></i>General
                            </a>
                            <a href="#notifications" class="list-group-item list-group-item-action"
                                data-bs-toggle="tab">
                                <i class="fas fa-bell me-2"></i>Notifications
                            </a>
                            <a href="#security" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                                <i class="fas fa-shield-alt me-2"></i>Security
                            </a>
                            <a href="#appearance" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                                <i class="fas fa-palette me-2"></i>Appearance
                            </a>
                            <a href="#backup" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                                <i class="fas fa-database me-2"></i>Backup & Export
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Settings Content -->
                <div class="col-lg-9">
                    <div class="tab-content">
                        <!-- General Settings -->
                        <div class="tab-pane fade show active" id="general">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">General Settings</h5>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Institution Name</label>
                                                <input type="text" class="form-control"
                                                    value="University of Excellence">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Academic Year</label>
                                                <select class="form-select">
                                                    <option>2024/2025</option>
                                                    <option>2023/2024</option>
                                                    <option>2022/2023</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Current Semester</label>
                                                <select class="form-select">
                                                    <option>First Semester</option>
                                                    <option>Second Semester</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Time Zone</label>
                                                <select class="form-select">
                                                    <option>GMT +1 (West Africa Time)</option>
                                                    <option>GMT +0 (Greenwich Mean Time)</option>
                                                    <option>GMT -5 (Eastern Time)</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Institution Logo</label>
                                                <input type="file" class="form-control" accept="image/*">
                                                <div class="form-text">Upload your institution logo (Max: 2MB, PNG/JPG)
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="enableRegistration" checked>
                                                    <label class="form-check-label" for="enableRegistration">
                                                        Allow new student registration
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="enableSubmissions" checked>
                                                    <label class="form-check-label" for="enableSubmissions">
                                                        Allow assignment submissions
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                            <button type="button" class="btn btn-outline-secondary ms-2">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Notification Settings -->
                        <div class="tab-pane fade" id="notifications">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Notification Preferences</h5>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <h6 class="mb-3">Email Notifications</h6>
                                        <div class="row g-3 mb-4">
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="emailNewSubmission" checked>
                                                    <label class="form-check-label" for="emailNewSubmission">
                                                        New assignment submission
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="emailDeadlineReminder" checked>
                                                    <label class="form-check-label" for="emailDeadlineReminder">
                                                        Assignment deadline reminders
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="emailNewRegistration">
                                                    <label class="form-check-label" for="emailNewRegistration">
                                                        New student registration
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="mb-3">System Notifications</h6>
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="systemUpdates"
                                                        checked>
                                                    <label class="form-check-label" for="systemUpdates">
                                                        System updates and maintenance
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="securityAlerts"
                                                        checked>
                                                    <label class="form-check-label" for="securityAlerts">
                                                        Security alerts and warnings
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Reminder Frequency</label>
                                                <select class="form-select">
                                                    <option>Daily</option>
                                                    <option>Weekly</option>
                                                    <option>Never</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary">Save Preferences</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Security Settings -->
                        <div class="tab-pane fade" id="security">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Password & Security</h5>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Current Password</label>
                                                <input type="password" class="form-control">
                                            </div>
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <label class="form-label">New Password</label>
                                                <input type="password" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Confirm New Password</label>
                                                <input type="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-warning">Change Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Login Security</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="twoFactorAuth">
                                                <label class="form-check-label" for="twoFactorAuth">
                                                    Enable Two-Factor Authentication
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="loginNotifications"
                                                    checked>
                                                <label class="form-check-label" for="loginNotifications">
                                                    Email notifications for new logins
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Session Timeout</label>
                                            <select class="form-select">
                                                <option>30 minutes</option>
                                                <option>1 hour</option>
                                                <option>2 hours</option>
                                                <option>4 hours</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Appearance Settings -->
                        <div class="tab-pane fade" id="appearance">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Interface Customization</h5>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Language</label>
                                                <select class="form-select">
                                                    <option>English</option>
                                                    <option>French</option>
                                                    <option>Spanish</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Date Format</label>
                                                <select class="form-select">
                                                    <option>DD/MM/YYYY</option>
                                                    <option>MM/DD/YYYY</option>
                                                    <option>YYYY-MM-DD</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Items Per Page</label>
                                                <select class="form-select">
                                                    <option>10</option>
                                                    <option>25</option>
                                                    <option>50</option>
                                                    <option>100</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Dashboard Layout</label>
                                                <select class="form-select">
                                                    <option>Standard</option>
                                                    <option>Compact</option>
                                                    <option>Detailed</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="sidebarCollapsed">
                                                    <label class="form-check-label" for="sidebarCollapsed">
                                                        Start with sidebar collapsed
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary">Save Settings</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Backup & Export Settings -->
                        <div class="tab-pane fade" id="backup">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Data Export</h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted mb-3">Export your data for backup or migration purposes</p>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="card border">
                                                <div class="card-body text-center">
                                                    <i class="fas fa-users fa-2x text-primary mb-3"></i>
                                                    <h6>Student Data</h6>
                                                    <p class="text-muted small">Export all student information</p>
                                                    <button class="btn btn-outline-primary btn-sm">Export CSV</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card border">
                                                <div class="card-body text-center">
                                                    <i class="fas fa-book fa-2x text-success mb-3"></i>
                                                    <h6>Assignment Data</h6>
                                                    <p class="text-muted small">Export assignment records</p>
                                                    <button class="btn btn-outline-success btn-sm">Export CSV</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card border">
                                                <div class="card-body text-center">
                                                    <i class="fas fa-comments fa-2x text-warning mb-3"></i>
                                                    <h6>Feedback Data</h6>
                                                    <p class="text-muted small">Export feedback and grades</p>
                                                    <button class="btn btn-outline-warning btn-sm">Export CSV</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card border">
                                                <div class="card-body text-center">
                                                    <i class="fas fa-university fa-2x text-info mb-3"></i>
                                                    <h6>Faculty Structure</h6>
                                                    <p class="text-muted small">Export faculties & departments</p>
                                                    <button class="btn btn-outline-info btn-sm">Export CSV</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">System Backup</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="autoBackup" checked>
                                                <label class="form-check-label" for="autoBackup">
                                                    Enable automatic daily backups
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Backup Retention</label>
                                            <select class="form-select">
                                                <option>7 days</option>
                                                <option>30 days</option>
                                                <option>90 days</option>
                                                <option>1 year</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary">
                                                <i class="fas fa-download me-2"></i>Create Manual Backup
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="/assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/assets/js/admin.js"></script>
    <script src="/assets/js/settings.js"></script>
</body>

</html>