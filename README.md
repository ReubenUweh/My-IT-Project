## A web-based academic system that allows students to submit assignments, track status, and receive lecturer feedback. Built with HTML, CSS, Bootstrap 5, JavaScript, PHP, and MySQL, it enhances academic communication and improves feedback quality.

## 🌍 Why It Matters
Solves real academic workflow issues

Demonstrates full stack development

Professional UI with modern animations

Ideal for portfolios and project defense

## 🔧 Technologies
Tool	Role
HTML/CSS	Page structure and styling
Bootstrap 5	UI components and responsiveness
JavaScript	Interactivity and DOM control
PHP	Server-side logic
MySQL	Database (users, assignments, feedback)
Font Awesome	Icons and visual appeal

## 🧭 Page Structure
Header: Site name, nav (Home, Uploads, Submissions, Feedback)

Hero: Welcome message, CTA with animation

Upload: Form (file, course, comment)

Feedback: Lecturer remarks, file preview, status

Footer: Contact, social links, credits

## ✨ UI Features
Scroll-triggered fade-ins

Animated button interactions

Clean, mobile-first design

## 🔐 Server-Side Features (Beyond Database)
User Auth: Session control, hashed passwords, role-based redirection

Secure File Upload: Validate file type/size, rename files, prevent script injection

Form Validation: Check inputs, return clean errors, sanitize data

Dynamic Views: Display user-specific uploads and feedback

Feedback System: Lecturer posts messages/status updates

Search & Filter: Filter by course or submission state (GET params)

## 🧠 Database Tables
sql
Copy
Edit
users (matric_no, name, password, role)
assignments (id, student_id, course, file_path, comment, submitted_at)
feedback (id, assignment_id, lecturer_name, category, message, rating, created_at)

## 🔁 Logic Flow
plaintext
Copy
Edit
[Start]
 ↓
[Login/Register]
 ↓
[Dashboard / Upload Page]
 ↓
[Submit Assignment → PHP Validation]
 ↓
[Save to Database]
 ↓
[Lecturer Posts Feedback]
 ↓
[Student Views Feedback]
 ↓
[End]

project-root/
├── controllers/
│   ├── AuthController.php       # Main authentication controller
│   ├── RegisterController.php  # (Optional) Separate register controller
│   └── LoginController.php     # (Optional) Separate login controller
├── models/
│   ├── User.php                # User model
│   └── Auth.php                # Authentication model
├── views/
│   ├── auth/
│   │   ├── login.php           # Login view
│   │   └── register.php        # Register view
│   └── layouts/                # (Optional) Layout templates
├── config/
│   ├── database.php            # Database configuration
│   └── security.php           # Security settings
├── public/
│   ├── assets/                 # CSS, JS, images
│   └── index.php               # Front controller
└── includes/                   # (Optional) Helper files
    ├── functions.php           # Utility functions
    └── validation.php          # Validation helpers