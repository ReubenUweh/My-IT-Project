// Students Management for JavaScript
document.addEventListener("DOMContentLoaded", function () {
  initializeStudentsPage();
});

function initializeStudentsPage() {
  setupStudentFilters();
  setupStudentForm();
  loadStudents();
}

// Setup filter functionality
function setupStudentFilters() {
  const filterElements = document.querySelectorAll(
    "#filterFaculty, #filterDepartment, #searchStudent"
  );

  filterElements.forEach(function (filter) {
    filter.addEventListener("change", filterStudents);
    if (filter.id === "searchStudent") {
      filter.addEventListener("input", filterStudents);
    }
  });

  // Faculty change should update departments
  const facultyFilter = document.getElementById("filterFaculty");
  if (facultyFilter) {
    facultyFilter.addEventListener("change", function () {
      updateDepartmentOptions(this.value);
      filterStudents();
    });
  }
}

// Setup student form
function setupStudentForm() {
  const form = document.getElementById("addStudentForm");
  if (form) {
    form.addEventListener("submit", function (event) {
      event.preventDefault();
      submitStudentForm();
    });
  }

  // Faculty change should update departments in form
  const facultySelect = form?.querySelector('select[name="faculty"]');
  if (facultySelect) {
    facultySelect.addEventListener("change", function () {
      updateFormDepartmentOptions(this.value);
    });
  }
}

// Load students data
function loadStudents() {
  updateStudentStats();
}

// Combined filter function that handles all filters
function filterStudents() {
  const searchTerm = document
    .getElementById("searchStudent")
    .value.toLowerCase();
  const facultyFilter = document.getElementById("filterFaculty").value;
  const departmentFilter = document.getElementById("filterDepartment").value;

  const rows = document.querySelectorAll("#studentsTable tbody tr");

  rows.forEach(function (row) {
    // Get all relevant data from the row
    const id = row.cells[1].textContent.toLowerCase();
    const firstName = row.cells[2].textContent.toLowerCase();
    const lastName = row.cells[3].textContent.toLowerCase();
    const matric = row.cells[4].textContent.toLowerCase();
    const faculty = row.cells[5].textContent.trim();
    const departmentId = row.cells[6].getAttribute("data-dept-id") || "";

    const fullName = `${firstName} ${lastName}`;

    // Check all filter conditions
    let matchesSearch =
      !searchTerm ||
      fullName.includes(searchTerm) ||
      matric.includes(searchTerm) ||
      id.includes(searchTerm);

    let matchesFaculty = !facultyFilter || faculty === facultyFilter;
    let matchesDepartment =
      !departmentFilter || departmentId === departmentFilter;

    // Apply the final visibility
    row.style.display =
      matchesSearch && matchesFaculty && matchesDepartment ? "" : "none";
  });

  updateVisibleStudentCount();
}

// Update department options based on selected faculty
function updateDepartmentOptions(facultyName) {
  const departmentFilter = document.getElementById("filterDepartment");
  const allOptions = departmentFilter.querySelectorAll("option[data-faculty]");

  // Clear existing options except "All Departments"
  departmentFilter.innerHTML = '<option value="">All Departments</option>';

  // Add departments based on faculty
  allOptions.forEach((option) => {
    if (!facultyName || option.getAttribute("data-faculty") === facultyName) {
      departmentFilter.appendChild(option.cloneNode(true));
    }
  });
}

// Update visible student count
function updateVisibleStudentCount() {
  const visibleRows = document.querySelectorAll(
    '#studentsTable tbody tr:not([style*="display: none"])'
  );
  const totalRows = document.querySelectorAll("#studentsTable tbody tr").length;

  console.log(`Showing ${visibleRows.length} of ${totalRows} students`);
}

// Export students data
function exportStudents() {
  const visibleRows = document.querySelectorAll(
    '#studentsTable tbody tr:not([style*="display: none"])'
  );
  const data = [];

  visibleRows.forEach(function (row) {
    const cells = row.cells;
    data.push({
      name: `${cells[2].textContent.trim()} ${cells[3].textContent.trim()}`,
      matric: cells[4].textContent.trim(),
      faculty: cells[5].textContent.trim(),
      department: cells[6].textContent.trim(),
    });
  });

  // Convert to CSV
  const csvContent = convertToCSV(data);
  downloadCSV(csvContent, "students.csv");
}

// Convert data to CSV format
function convertToCSV(data) {
  if (data.length === 0) return "";

  const headers = Object.keys(data[0]);
  const csvRows = [headers.join(",")];

  data.forEach(function (row) {
    const values = headers.map(function (header) {
      const value = row[header] || "";
      return `"${value.replace(/"/g, '""')}"`;
    });
    csvRows.push(values.join(","));
  });

  return csvRows.join("\n");
}

// Download CSV file
function downloadCSV(csvContent, filename) {
  const blob = new Blob([csvContent], { type: "text/csv" });
  const url = window.URL.createObjectURL(blob);
  const link = document.createElement("a");
  link.href = url;
  link.download = filename;
  link.click();
  window.URL.revokeObjectURL(url);
}
