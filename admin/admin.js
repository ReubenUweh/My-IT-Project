//    // lecturer data (to be fetched dynamically in real deployment)
//     const lecturer = {
//       name: "Dr. Chidi Okafor",
//       faculty: "Engineering",
//       department: "Electrical Engineering",
//       course: "CSC- Power Systems"
//     };

//     const feedbacks = [
//       { matric: "ENG20201234", message: "Assignment was fair and clear." },
//       { matric: "ENG20204567", message: "Could we have more time on the next one?" }
//     ];

//     // Display lecturer info
//     document.getElementById("lecturerName").textContent = lecturer.name;
//     document.getElementById("facultyName").textContent = lecturer.faculty;
//     document.getElementById("departmentName").textContent = lecturer.department;
//     document.getElementById("courseCode").textContent = lecturer.course;

//     // Display feedbacks
//     const feedbackList = document.getElementById("feedbackList");
//     feedbacks.forEach(fb => {
//       const div = document.createElement("div");
//       div.className = "alert alert-secondary mb-2";
//       div.innerHTML = `<strong>${fb.matric}</strong><br>${fb.message}`;
//       feedbackList.appendChild(div);
//     });

//     // Handle assignment upload form (mocked)
//     document.getElementById("assignmentForm").addEventListener("submit", function(e) {
//       e.preventDefault();
//       alert("Assignment uploaded successfully!");
//       this.reset();
//     });

//      <nav class="navbar navbar-expand-lg bg-light shadow-sm px-4">
//     <a class="navbar-brand fw-bold" href="#">ClassTrack</a>
//     <div class="ms-auto">
//       <span id="lecturerName" class="me-3 text-primary fw-semibold"></span>
//       <a class="btn btn-outline-primary" href="#">Logout</a>
//     </div>
//   </nav>