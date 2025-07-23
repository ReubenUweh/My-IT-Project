// Assignments Management JavaScript

document.addEventListener('DOMContentLoaded', function() {
    initializeAssignmentsPage();
});

function initializeAssignmentsPage() {
    setupAssignmentFilters();
    setupAssignmentForm();
    loadAssignments();
    updateAssignmentProgress();
}

// Setup filter functionality
function setupAssignmentFilters() {
    const filterElements = document.querySelectorAll('.card-body select, .card-body input[type="text"]');
    
    filterElements.forEach(function(filter) {
        filter.addEventListener('change', function() {
            filterAssignments();
        });
        
        filter.addEventListener('input', function() {
            filterAssignments();
        });
    });

    // Faculty change should update departments
    const facultyFilter = document.querySelector('.card-body select:nth-of-type(2)');
    if (facultyFilter) {
        facultyFilter.addEventListener('change', function() {
            updateDepartmentFilter(this.value);
        });
    }
}

// Setup assignment form
function setupAssignmentForm() {
    const form = document.getElementById('createAssignmentForm');
    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            submitAssignmentForm();
        });
    }

    // Faculty change should update departments in form
    const facultySelect = form?.querySelector('select[name="faculty"]');
    if (facultySelect) {
        facultySelect.addEventListener('change', function() {
            updateFormDepartmentOptions(this.value);
        });
    }

    // File type checkboxes
    const fileTypeCheckboxes = form?.querySelectorAll('input[type="checkbox"]');
    if (fileTypeCheckboxes) {
        fileTypeCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                validateFileTypes();
            });
        });
    }
}

// Load assignments data
function loadAssignments() {
    // This would typically fetch from an API
    updateAssignmentStats();
}

// Filter assignments based on criteria
function filterAssignments() {
    const searchTerm = document.querySelector('.card-body input[type="text"]').value.toLowerCase();
    const facultyFilter = document.querySelector('.card-body select:nth-of-type(2)').value;
    const departmentFilter = document.querySelector('.card-body select:nth-of-type(3)').value;
    const statusFilter = document.querySelector('.card-body select:nth-of-type(4)').value;
    
    const assignmentItems = document.querySelectorAll('.assignment-item');
    
    assignmentItems.forEach(function(item) {
        const title = item.querySelector('h6').textContent.toLowerCase();
        const description = item.querySelector('p').textContent.toLowerCase();
        const status = item.querySelector('.badge').textContent.toLowerCase();
        
        let showItem = true;
        
        // Search filter
        if (searchTerm && !title.includes(searchTerm) && !description.includes(searchTerm)) {
            showItem = false;
        }
        
        // Status filter
        if (statusFilter && !status.includes(statusFilter.toLowerCase())) {
            showItem = false;
        }
        
        item.style.display = showItem ? '' : 'none';
    });
    
    updateVisibleAssignmentCount();
}

// Update department filter options
function updateDepartmentFilter(faculty) {
    const departmentFilter = document.querySelector('.card-body select:nth-of-type(3)');
    
    // Clear existing options
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

// Update form department options
function updateFormDepartmentOptions(faculty) {
    const departmentSelect = document.querySelector('#createAssignmentForm select[name="department"]');
    if (!departmentSelect) return;
    
    // Clear existing options
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

// Get departments by faculty
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

// Validate file types selection
function validateFileTypes() {
    const checkboxes = document.querySelectorAll('#createAssignmentForm input[type="checkbox"]:checked');
    const errorElement = document.getElementById('fileTypeError');
    
    if (checkboxes.length === 0) {
        if (!errorElement) {
            const error = document.createElement('div');
            error.id = 'fileTypeError';
            error.className = 'text-danger small mt-1';
            error.textContent = 'Please select at least one file type';
            document.querySelector('.form-check-group').appendChild(error);
        }
        return false;
    } else {
        if (errorElement) {
            errorElement.remove();
        }
        return true;
    }
}

// Submit assignment form
function submitAssignmentForm() {
    const form = document.getElementById('createAssignmentForm');
    
    // Validate file types
    if (!validateFileTypes()) {
        return;
    }
    
    const formData = new FormData(form);
    
    // Show loading state
    const submitButton = form.querySelector('button[type="submit"]');
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating Assignment...';
    submitButton.disabled = true;
    
    // Simulate API call
    setTimeout(function() {
        // Reset form
        form.reset();
        
        // Reset button
        submitButton.innerHTML = originalText;
        submitButton.disabled = false;
        
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('createAssignmentModal'));
        modal.hide();
        
        // Show success message
        showNotification('Assignment created successfully!', 'success');
        
        // Add assignment to list
        addAssignmentToList(formData);
        
        // Update stats
        updateAssignmentStats();
        
    }, 2000);
}

// Add assignment to list
function addAssignmentToList(formData) {
    const container = document.querySelector('.assignment-item').parentElement;
    const newItem = document.createElement('div');
    newItem.className = 'assignment-item';
    
    const title = formData.get('title') || 'New Assignment';
    const department = formData.get('department') || 'Computer Science';
    const level = formData.get('level') || '100';
    const dueDate = formData.get('dueDate') || new Date().toISOString().slice(0, 16);
    
    // Get selected file types
    const fileTypes = [];
    const checkboxes = document.querySelectorAll('#createAssignmentForm input[type="checkbox"]:checked');
    checkboxes.forEach(function(checkbox) {
        fileTypes.push(checkbox.value.toUpperCase());
    });
    
    const formattedDate = new Date(dueDate).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
    
    newItem.innerHTML = `
        <div class="d-flex justify-content-between align-items-start p-3 border-bottom">
            <div class="flex-grow-1">
                <h6 class="mb-1">${title}</h6>
                <p class="text-muted mb-2">${department} - ${level} Level</p>
                <div class="d-flex align-items-center gap-3">
                    <small class="text-muted">
                        <i class="fas fa-calendar me-1"></i>Due: ${formattedDate}
                    </small>
                    <small class="text-muted">
                        <i class="fas fa-file me-1"></i>${fileTypes.join(', ')} allowed
                    </small>
                    <small class="text-muted">
                        <i class="fas fa-users me-1"></i>0 submissions
                    </small>
                </div>
            </div>
            <div class="text-end">
                <span class="badge bg-success">Active</span>
                <div class="btn-group btn-group-sm mt-2">
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
            </div>
        </div>
    `;
    
    container.appendChild(newItem);
}

// Update assignment statistics
function updateAssignmentStats() {
    const assignmentItems = document.querySelectorAll('.assignment-item');
    const activeAssignments = document.querySelectorAll('.assignment-item .badge.bg-success').length;
    const completedAssignments = document.querySelectorAll('.assignment-item .badge.bg-primary').length;
    const overdueAssignments = document.querySelectorAll('.assignment-item .badge.bg-danger').length;
    
    // Update stat cards
    const statCards = document.querySelectorAll('.card.text-center h4');
    if (statCards[0]) statCards[0].textContent = assignmentItems.length;
    if (statCards[1]) statCards[1].textContent = activeAssignments;
    if (statCards[2]) statCards[2].textContent = completedAssignments;
    if (statCards[3]) statCards[3].textContent = overdueAssignments;
}

// Update assignment progress
function updateAssignmentProgress() {
    const progressItems = document.querySelectorAll('.progress-item');
    
    progressItems.forEach(function(item) {
        const progressBar = item.querySelector('.progress-bar');
        const percentage = progressBar.style.width;
        
        // Animate progress bar
        progressBar.style.width = '0%';
        setTimeout(function() {
            progressBar.style.width = percentage;
        }, 100);
    });
}

// Update visible assignment count
function updateVisibleAssignmentCount() {
    const visibleItems = document.querySelectorAll('.assignment-item:not([style*="display: none"])');
    const totalItems = document.querySelectorAll('.assignment-item').length;
    
    console.log(`Showing ${visibleItems.length} of ${totalItems} assignments`);
}

// Export assignments data
function exportAssignments() {
    const visibleItems = document.querySelectorAll('.assignment-item:not([style*="display: none"])');
    const data = [];
    
    visibleItems.forEach(function(item) {
        const title = item.querySelector('h6').textContent.trim();
        const description = item.querySelector('p').textContent.trim();
        const status = item.querySelector('.badge').textContent.trim();
        const dueDate = item.querySelector('small').textContent.replace('Due: ', '').trim();
        
        data.push({
            title: title,
            description: description,
            status: status,
            dueDate: dueDate
        });
    });
    
    // Convert to CSV
    const csvContent = convertToCSV(data);
    downloadCSV(csvContent, 'assignments.csv');
}

// Send reminders for assignments
function sendReminders() {
    const activeAssignments = document.querySelectorAll('.assignment-item .badge.bg-warning, .assignment-item .badge.bg-success').length;
    
    if (activeAssignments === 0) {
        showNotification('No active assignments to send reminders for', 'info');
        return;
    }
    
    showNotification('Sending reminders...', 'info');
    
    setTimeout(function() {
        showNotification(`Reminders sent for ${activeAssignments} active assignment(s)`, 'success');
    }, 2000);
}

// View assignment analytics
function viewAnalytics() {
    showNotification('Opening assignment analytics...', 'info');
    
    // This would typically open a new page or modal with analytics
    setTimeout(function() {
        showNotification('Analytics feature coming soon!', 'info');
    }, 1000);
}

// Delete assignment
function deleteAssignment(button) {
    const assignmentItem = button.closest('.assignment-item');
    const title = assignmentItem.querySelector('h6').textContent;
    
    if (confirm(`Are you sure you want to delete "${title}"?`)) {
        assignmentItem.remove();
        showNotification('Assignment deleted successfully', 'success');
        updateAssignmentStats();
    }
}

// Edit assignment
function editAssignment(button) {
    const assignmentItem = button.closest('.assignment-item');
    const title = assignmentItem.querySelector('h6').textContent;
    
    showNotification(`Edit functionality for "${title}" coming soon!`, 'info');
}

// View assignment details
function viewAssignment(button) {
    const assignmentItem = button.closest('.assignment-item');
    const title = assignmentItem.querySelector('h6').textContent;
    
    showNotification(`View functionality for "${title}" coming soon!`, 'info');
}

// Utility function to convert data to CSV
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

// Utility function to download CSV
function downloadCSV(csvContent, filename) {
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = filename;
    link.click();
    window.URL.revokeObjectURL(url);
}