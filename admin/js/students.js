// Students Management JavaScript

document.addEventListener('DOMContentLoaded', function() {
    initializeStudentsPage();
});

function initializeStudentsPage() {
    setupStudentFilters();
    setupStudentSearch();
    setupStudentForm();
    loadStudents();
}

// Setup filter functionality
function setupStudentFilters() {
    const filterElements = document.querySelectorAll('#filterFaculty, #filterDepartment, #filterStatus');
    
    filterElements.forEach(function(filter) {
        filter.addEventListener('change', function() {
            filterStudents();
        });
    });

    // Faculty change should update departments
    const facultyFilter = document.getElementById('filterFaculty');
    if (facultyFilter) {
        facultyFilter.addEventListener('change', function() {
            updateDepartmentOptions(this.value);
        });
    }
}

// Setup search functionality
function setupStudentSearch() {
    const searchInput = document.getElementById('searchStudent');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            filterStudentsBySearch(searchTerm);
        });
    }
}

// Setup student form
function setupStudentForm() {
    const form = document.getElementById('addStudentForm');
    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            submitStudentForm();
        });
    }

    // Faculty change should update departments in form
    const facultySelect = form?.querySelector('select[name="faculty"]');
    if (facultySelect) {
        facultySelect.addEventListener('change', function() {
            updateFormDepartmentOptions(this.value);
        });
    }
}

// Load students data
function loadStudents() {
    // This would typically fetch from an API
    // For now, we'll work with the existing table data
    updateStudentStats();
}

// Filter students based on selected criteria
function filterStudents() {
    const facultyFilter = document.getElementById('filterFaculty').value;
    const departmentFilter = document.getElementById('filterDepartment').value;
    const statusFilter = document.getElementById('filterStatus').value;
    
    const rows = document.querySelectorAll('#studentsTable tbody tr');
    
    rows.forEach(function(row) {
        const faculty = row.cells[3].textContent.trim();
        const department = row.cells[4].textContent.trim();
        const status = row.cells[6].querySelector('.badge').textContent.trim();
        
        let showRow = true;
        
        if (facultyFilter && !faculty.toLowerCase().includes(facultyFilter.toLowerCase())) {
            showRow = false;
        }
        
        if (departmentFilter && !department.toLowerCase().includes(departmentFilter.toLowerCase())) {
            showRow = false;
        }
        
        if (statusFilter && status.toLowerCase() !== statusFilter.toLowerCase()) {
            showRow = false;
        }
        
        row.style.display = showRow ? '' : 'none';
    });
    
    updateVisibleStudentCount();
}

// Filter students by search term
function filterStudentsBySearch(searchTerm) {
    const rows = document.querySelectorAll('#studentsTable tbody tr');
    
    rows.forEach(function(row) {
        const name = row.cells[1].textContent.toLowerCase();
        const matric = row.cells[2].textContent.toLowerCase();
        
        if (name.includes(searchTerm) || matric.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
    
    updateVisibleStudentCount();
}

// Update department options based on selected faculty
function updateDepartmentOptions(faculty) {
    const departmentFilter = document.getElementById('filterDepartment');
    
    // Clear existing options except "All Departments"
    departmentFilter.innerHTML = '<option value="">All Departments</option>';
    
    // Add departments based on faculty
    const departments = getDepartmentsByFaculty(faculty);
    departments.forEach(function(dept) {
        const option = document.createElement('option');
        option.value = dept.value;
        option.textContent = dept.text;
        departmentFilter.appendChild(option);
    });
}

// Update department options in the form
function updateFormDepartmentOptions(faculty) {
    const departmentSelect = document.querySelector('#addStudentForm select[name="department"]');
    if (!departmentSelect) return;
    
    // Clear existing options except "Select Department"
    departmentSelect.innerHTML = '<option value="">Select Department</option>';
    
    // Add departments based on faculty
    const departments = getDepartmentsByFaculty(faculty);
    departments.forEach(function(dept) {
        const option = document.createElement('option');
        option.value = dept.value;
        option.textContent = dept.text;
        departmentSelect.appendChild(option);
    });
}

// Get departments by faculty (mock data)
function getDepartmentsByFaculty(faculty) {
    const departmentMap = {
        'engineering': [
            { value: 'computer', text: 'Computer Science' },
            { value: 'mechanical', text: 'Mechanical Engineering' },
            { value: 'electrical', text: 'Electrical Engineering' },
            { value: 'civil', text: 'Civil Engineering' }
        ],
        'science': [
            { value: 'mathematics', text: 'Mathematics' },
            { value: 'physics', text: 'Physics' },
            { value: 'chemistry', text: 'Chemistry' },
            { value: 'biology', text: 'Biology' }
        ],
        'arts': [
            { value: 'english', text: 'English Language' },
            { value: 'history', text: 'History' },
            { value: 'philosophy', text: 'Philosophy' }
        ]
    };
    
    return departmentMap[faculty] || [];
}

// Submit student form
function submitStudentForm() {
    const form = document.getElementById('addStudentForm');
    const formData = new FormData(form);
    
    // Show loading state
    const submitButton = form.querySelector('button[type="submit"]');
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding Student...';
    submitButton.disabled = true;
    
    // Simulate API call
    setTimeout(function() {
        // Reset form
        form.reset();
        
        // Reset button
        submitButton.innerHTML = originalText;
        submitButton.disabled = false;
        
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('addStudentModal'));
        modal.hide();
        
        // Show success message
        showNotification('Student added successfully!', 'success');
        
        // Add student to table (mock)
        addStudentToTable(formData);
        
        // Update stats
        updateStudentStats();
        
    }, 2000);
}

// Add student to table (mock implementation)
function addStudentToTable(formData) {
    const tbody = document.querySelector('#studentsTable tbody');
    const newRow = document.createElement('tr');
    
    const firstName = formData.get('firstName') || 'John';
    const lastName = formData.get('lastName') || 'Doe';
    const email = formData.get('email') || 'john.doe@university.edu';
    const matric = formData.get('matric') || 'NEW/2024/001';
    const faculty = formData.get('faculty') || 'Engineering';
    const department = formData.get('department') || 'Computer Science';
    const level = formData.get('level') || '100';
    
    newRow.innerHTML = `
        <td><input type="checkbox" class="form-check-input"></td>
        <td>
            <div class="d-flex align-items-center">
                <div class="avatar me-2">
                    <i class="fas fa-user-circle fa-2x text-muted"></i>
                </div>
                <div>
                    <h6 class="mb-0">${firstName} ${lastName}</h6>
                    <small class="text-muted">${email}</small>
                </div>
            </div>
        </td>
        <td>${matric}</td>
        <td>${faculty}</td>
        <td>${department}</td>
        <td><span class="badge bg-primary">${level} Level</span></td>
        <td><span class="badge bg-success">Active</span></td>
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
    `;
    
    tbody.appendChild(newRow);
    
    // Add event listeners to new row
    const checkbox = newRow.querySelector('input[type="checkbox"]');
    checkbox.addEventListener('change', updateBulkActions);
}

// Update student statistics
function updateStudentStats() {
    const rows = document.querySelectorAll('#studentsTable tbody tr');
    const visibleRows = document.querySelectorAll('#studentsTable tbody tr:not([style*="display: none"])');
    
    console.log(`Total students: ${rows.length}, Visible: ${visibleRows.length}`);
}

// Update visible student count
function updateVisibleStudentCount() {
    const visibleRows = document.querySelectorAll('#studentsTable tbody tr:not([style*="display: none"])');
    const totalRows = document.querySelectorAll('#studentsTable tbody tr').length;
    
    // You can update a counter element here if needed
    console.log(`Showing ${visibleRows.length} of ${totalRows} students`);
}

// Export students data
function exportStudents() {
    const visibleRows = document.querySelectorAll('#studentsTable tbody tr:not([style*="display: none"])');
    const data = [];
    
    visibleRows.forEach(function(row) {
        const cells = row.cells;
        data.push({
            name: cells[1].textContent.trim().split('\n')[0],
            matric: cells[2].textContent.trim(),
            faculty: cells[3].textContent.trim(),
            department: cells[4].textContent.trim(),
            level: cells[5].textContent.trim(),
            status: cells[6].textContent.trim()
        });
    });
    
    // Convert to CSV
    const csvContent = convertToCSV(data);
    downloadCSV(csvContent, 'students.csv');
}

// Convert data to CSV format
function convertToCSV(data) {
    if (data.length === 0) return '';
    
    const headers = Object.keys(data[0]);
    const csvRows = [headers.join(',')];
    
    data.forEach(function(row) {
        const values = headers.map(function(header) {
            const value = row[header] || '';
            return `"${value.replace(/"/g, '""')}"`;
        });
        csvRows.push(values.join(','));
    });
    
    return csvRows.join('\n');
}

// Download CSV file
function downloadCSV(csvContent, filename) {
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = filename;
    link.click();
    window.URL.revokeObjectURL(url);
}

// Bulk delete students
function bulkDeleteStudents() {
    const checkedBoxes = document.querySelectorAll('#studentsTable tbody input[type="checkbox"]:checked');
    
    if (checkedBoxes.length === 0) {
        showNotification('Please select students to delete', 'warning');
        return;
    }
    
    if (confirm(`Are you sure you want to delete ${checkedBoxes.length} student(s)?`)) {
        checkedBoxes.forEach(function(checkbox) {
            const row = checkbox.closest('tr');
            row.remove();
        });
        
        showNotification(`${checkedBoxes.length} student(s) deleted successfully`, 'success');
        updateStudentStats();
        updateBulkActions();
    }
}

// Print students list
function printStudents() {
    const printWindow = window.open('', '_blank');
    const studentsTable = document.getElementById('studentsTable').cloneNode(true);
    
    // Remove action columns and checkboxes
    const checkboxCells = studentsTable.querySelectorAll('td:first-child, th:first-child');
    const actionCells = studentsTable.querySelectorAll('td:last-child, th:last-child');
    
    checkboxCells.forEach(cell => cell.remove());
    actionCells.forEach(cell => cell.remove());
    
    printWindow.document.write(`
        <html>
            <head>
                <title>Students List</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    body { padding: 20px; }
                    .table { font-size: 12px; }
                    @media print {
                        .table { font-size: 10px; }
                    }
                </style>
            </head>
            <body>
                <h2>Students List</h2>
                <p>Generated on: ${new Date().toLocaleDateString()}</p>
                ${studentsTable.outerHTML}
            </body>
        </html>
    `);
    
    printWindow.document.close();
    printWindow.print();
}