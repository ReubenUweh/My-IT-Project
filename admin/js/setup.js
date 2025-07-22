// Admin Setup JavaScript for Faculty & Department Management

document.addEventListener('DOMContentLoaded', function() {
    initializeAdminSetup();
});

function initializeAdminSetup() {
    setupFacultyForm();
    setupDepartmentForm();
    setupFilters();
    loadFacultyDepartmentData();
}

// Setup faculty form
function setupFacultyForm() {
    const form = document.getElementById('addFacultyForm');
    if (form) {
        form.addEventListener('submit', function(event) {
            // event.preventDefault();
            submitFacultyForm();
        });

        // Auto-generate faculty code from name
        const nameInput = document.getElementById('facultyName');
        const codeInput = document.getElementById('facultyCode');
        
        if (nameInput && codeInput) {
            nameInput.addEventListener('input', function() {
                const name = this.value.trim();
                if (name) {
                    const code = generateFacultyCode(name);
                    codeInput.value = code;
                }
            });
        }
    }
}

// Setup department form
function setupDepartmentForm() {
    const form = document.getElementById('addDepartmentForm');
    if (form) {
        form.addEventListener('submit', function(event) {
            // event.preventDefault();
            submitDepartmentForm();
        });

        // Auto-generate department code from name
        const nameInput = document.getElementById('departmentName');
        const codeInput = document.getElementById('departmentCode');
        
        if (nameInput && codeInput) {
            nameInput.addEventListener('input', function() {
                const name = this.value.trim();
                if (name) {
                    const code = generateDepartmentCode(name);
                    codeInput.value = code;
                }
            });
        }

        // Validate at least one level is selected
        const levelCheckboxes = form.querySelectorAll('input[name="studentLevels[]"]');
        levelCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                validateLevelSelection();
            });
        });
    }
}

// Setup filters
function setupFilters() {
    const facultyFilter = document.getElementById('filterFaculty');
    if (facultyFilter) {
        facultyFilter.addEventListener('change', function() {
            filterDepartments(this.value);
        });
    }
}

// Generate faculty code from name
function generateFacultyCode(name) {
    // Take first 3-4 characters of each word
    const words = name.split(' ');
    let code = '';
    
    if (words.length === 1) {
        code = words[0].substring(0, 4).toUpperCase();
    } else {
        code = words.map(word => word.charAt(0)).join('').toUpperCase();
        if (code.length < 3) {
            code = words[0].substring(0, 3).toUpperCase();
        }
    }
    
    return code;
}

// Generate department code from name
function generateDepartmentCode(name) {
    // Similar logic to faculty code but limited to 3 characters
    const words = name.split(' ');
    let code = '';
    
    if (words.length === 1) {
        code = words[0].substring(0, 3).toUpperCase();
    } else if (words.length === 2) {
        code = words[0].substring(0, 2).toUpperCase() + words[1].charAt(0).toUpperCase();
    } else {
        code = words.map(word => word.charAt(0)).join('').substring(0, 3).toUpperCase();
    }
    
    return code;
}

// Validate level selection
function validateLevelSelection() {
    const checkboxes = document.querySelectorAll('input[name="studentLevels[]"]:checked');
    const errorElement = document.getElementById('levelError');
    
    if (checkboxes.length === 0) {
        if (!errorElement) {
            const error = document.createElement('div');
            error.id = 'levelError';
            error.className = 'text-danger small mt-1';
            error.textContent = 'Please select at least one student level';
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

// Submit faculty form
function submitFacultyForm() {
    const form = document.getElementById('addFacultyForm');
    const formData = new FormData(form);
    
    // Basic validation
    const facultyName = formData.get('facultyName').trim();
    const facultyCode = formData.get('facultyCode').trim();
    
    if (!facultyName || !facultyCode) {
        showNotification('Please fill in all required fields', 'warning');
        return;
    }

    // Check for duplicate codes
    if (checkDuplicateFacultyCode(facultyCode)) {
        showNotification('Faculty code already exists. Please choose a different code.', 'warning');
        return;
    }
    
    // Show loading state
    const submitButton = form.querySelector('button[type="submit"]');
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding Faculty...';
    submitButton.disabled = true;
    
    // Simulate API call
    setTimeout(function() {
        // Reset form
        form.reset();
        
        // Reset button
        submitButton.innerHTML = originalText;
        submitButton.disabled = false;
        
        // Show success message
        showNotification('Faculty added successfully!', 'success');
        
        // Add faculty to list
        addFacultyToList(formData);
        
        // Update faculty dropdown in department form
        updateFacultyDropdown(facultyName, facultyCode);
        
        // Update stats
        updateSetupStats();
        
    }, 1500);
}

// Submit department form
function submitDepartmentForm() {
    const form = document.getElementById('addDepartmentForm');
    
    // Validate level selection first
    if (!validateLevelSelection()) {
        return;
    }
    
    const formData = new FormData(form);
    
    // Basic validation
    const facultyId = formData.get('faculty_id');
    const departmentName = formData.get('departmentName').trim();
    const departmentCode = formData.get('departmentCode').trim();
    
    if (!facultyId || !departmentName || !departmentCode) {
        showNotification('Please fill in all required fields', 'warning');
        return;
    }

    // Check for duplicate codes
    if (checkDuplicateDepartmentCode(departmentCode)) {
        showNotification('Department code already exists. Please choose a different code.', 'warning');
        return;
    }
    
    // Show loading state
    const submitButton = form.querySelector('button[type="submit"]');
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding Department...';
    submitButton.disabled = true;
    
    // Simulate API call
    setTimeout(function() {
        // Reset form
        form.reset();
        
        // Reset button
        submitButton.innerHTML = originalText;
        submitButton.disabled = false;
        
        // Show success message
        showNotification('Department added successfully!', 'success');
        
        // Add department to list
        addDepartmentToList(formData);
        
        // Update stats
        updateSetupStats();
        
    }, 1500);
}

// Check for duplicate faculty code
function checkDuplicateFacultyCode(code) {
    const existingCodes = Array.from(document.querySelectorAll('.faculty-item p')).map(p => 
        p.textContent.replace('Code: ', '').trim()
    );
    return existingCodes.includes(code);
}

// Check for duplicate department code
function checkDuplicateDepartmentCode(code) {
    const existingCodes = Array.from(document.querySelectorAll('.department-item p')).map(p => 
        p.textContent.split(' • Code: ')[1]?.trim()
    ).filter(Boolean);
    return existingCodes.includes(code);
}

// Add faculty to list
function addFacultyToList(formData) {
    const facultyList = document.querySelector('.faculty-list');
    const newItem = document.createElement('div');
    newItem.className = 'faculty-item border-bottom py-3';
    
    const facultyName = formData.get('facultyName');
    const facultyCode = formData.get('facultyCode');
    
    newItem.innerHTML = `
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h6 class="mb-1">${facultyName}</h6>
                <p class="text-muted mb-0">Code: ${facultyCode}</p>
                <small class="text-success">0 Departments</small>
            </div>
            <div class="btn-group btn-group-sm">
                <button class="btn btn-outline-warning" title="Edit" onclick="editFaculty(this)">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-outline-danger" title="Delete" onclick="deleteFaculty(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;
    
    facultyList.appendChild(newItem);
}

// Update faculty dropdown in department form
function updateFacultyDropdown(facultyName, facultyCode) {
    const facultySelect = document.getElementById('faculty_id');
    const option = document.createElement('option');
    option.value = facultyCode; // In real implementation, this would be the faculty ID
    option.textContent = facultyName;
    facultySelect.appendChild(option);
}

// Update faculty department count
function updateFacultyDepartmentCount() {
    const facultyItems = document.querySelectorAll('.faculty-item');
    
    facultyItems.forEach(function(facultyItem) {
        const facultyName = facultyItem.querySelector('h6').textContent;
        const departmentCount = document.querySelectorAll(
            `.department-item p:contains("${facultyName}")`
        ).length;
        
        const countElement = facultyItem.querySelector('small');
        countElement.textContent = `${departmentCount} Department${departmentCount !== 1 ? 's' : ''}`;
    });
}

// Filter departments by faculty
function filterDepartments(faculty) {
    const departmentItems = document.querySelectorAll('.department-item');
    
    departmentItems.forEach(function(item) {
        const facultyText = item.querySelector('p').textContent;
        
        if (!faculty || facultyText.toLowerCase().includes(faculty.toLowerCase())) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}

// Load faculty and department data
function loadFacultyDepartmentData() {
    // This would typically fetch from an API
    updateSetupStats();
}

// Update setup statistics
function updateSetupStats() {
    const facultyCount = document.querySelectorAll('.faculty-item').length;
    const departmentCount = document.querySelectorAll('.department-item').length;
    
    // Update stat cards
    const statCards = document.querySelectorAll('.stat-item h4');
    if (statCards[0]) statCards[0].textContent = facultyCount;
    if (statCards[1]) statCards[1].textContent = departmentCount;
    
    // Available levels and registered students would come from API
    if (statCards[2]) statCards[2].textContent = '7'; // Available levels
    if (statCards[3]) statCards[3].textContent = '1,234'; // Registered students
}

// Edit faculty
function editFaculty(button) {
    const facultyItem = button.closest('.faculty-item');
    const facultyName = facultyItem.querySelector('h6').textContent;
    
    showNotification(`Edit functionality for "${facultyName}" coming soon!`, 'info');
}

// Edit department
function editDepartment(button) {
    const departmentItem = button.closest('.department-item');
    const departmentName = departmentItem.querySelector('h6').textContent;
    
    showNotification(`Edit functionality for "${departmentName}" coming soon!`, 'info');
}

// Refresh functions
function refreshFaculties() {
    showNotification('Refreshing faculties...', 'info');
    
    // Simulate refresh
    setTimeout(function() {
        showNotification('Faculties refreshed successfully!', 'success');
        updateSetupStats();
    }, 1000);
}

function refreshDepartments() {
    showNotification('Refreshing departments...', 'info');
    
    // Simulate refresh
    setTimeout(function() {
        showNotification('Departments refreshed successfully!', 'success');
        updateSetupStats();
    }, 1000);
}

// Export setup data
function exportSetupData() {
    const faculties = [];
    const departments = [];
    
    // Collect faculty data
    document.querySelectorAll('.faculty-item').forEach(function(item) {
        const name = item.querySelector('h6').textContent;
        const code = item.querySelector('p').textContent.replace('Code: ', '');
        faculties.push({ name, code });
    });
    
    // Collect department data
    document.querySelectorAll('.department-item').forEach(function(item) {
        const name = item.querySelector('h6').textContent;
        const details = item.querySelector('p').textContent.split(' • ');
        const faculty = details[0];
        const code = details[1].replace('Code: ', '');
        const levels = Array.from(item.querySelectorAll('.badge')).map(badge => 
            badge.textContent.replace('L', '')
        );
        departments.push({ name, faculty, code, levels: levels.join(',') });
    });
    
    // Export as CSV
    const facultyCSV = convertToCSV(faculties);
    const departmentCSV = convertToCSV(departments);
    
    downloadCSV(facultyCSV, 'faculties.csv');
    
    setTimeout(function() {
        downloadCSV(departmentCSV, 'departments.csv');
        showNotification('Setup data exported successfully!', 'success');
    }, 500);
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

function editFaculty(facultyId) {
    fetch(`/api/manageFaculty.php/${facultyId}`)
        .then(response => response.json())
        .then(data => {
            // edit form modal with data
            document.getElementById('editFacultyName').value = data.facultyName;
            document.getElementById('editFacultyCode').value = data.facultyCode;
            document.getElementById('editFacultyDescription').value = data.description;
            
            // Show edit modal
            const editModal = new bootstrap.Modal(document.getElementById('editFacultyModal'));
            editModal.show();
        });
}

function deleteFaculty(facultyId) {
    if (confirm('Are you sure you want to delete this faculty? All associated departments will also be deleted.')) {
        fetch(`./api/manageFaculty.php?id=${facultyId}`, { // Updated path
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showNotification('Faculty deleted successfully', 'success');
                // Refresh the page to show updated list
                location.reload();
            } else {
                showNotification('Failed to delete faculty', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error deleting faculty: ' + error.message, 'danger');
        });
    }
}

function deleteDepartment(departmentId) {
    if (confirm('Are you sure you want to delete this department?')) {
        // Show loading state on the button
        const deleteBtn = document.querySelector(`button[onclick="deleteDepartment(${departmentId})"]`);
        const originalHtml = deleteBtn.innerHTML;
        deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        deleteBtn.disabled = true;
        
        fetch(`./api/manageDepartment.php?id=${departmentId}`, {
            method: 'DELETE'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showNotification('Department deleted successfully', 'success');
                // Removing the department item from the DOM
                const departmentItem = document.querySelector(`.department-item[data-id="${departmentId}"]`);
                if (departmentItem) {
                    departmentItem.remove();
                }
                // Update stats
                updateSetupStats();
            } else {
                throw new Error(data.error || 'Failed to delete department');
            }
        })
        .catch(error => {
            showNotification('Error: ' + error.message, 'danger');
            console.error('Delete error:', error);
        })
        .finally(() => {
            // Restore button state
            if (deleteBtn) {
                deleteBtn.innerHTML = originalHtml;
                deleteBtn.disabled = false;
            }
        });
    }
}