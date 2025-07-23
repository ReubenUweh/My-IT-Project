// Feedback Management JavaScript

document.addEventListener('DOMContentLoaded', function() {
    initializeFeedbackPage();
});

function initializeFeedbackPage() {
    setupFeedbackFilters();
    setupFeedbackForm();
    loadSubmissions();
    updateGradeDistribution();
}

// Setup filter functionality
function setupFeedbackFilters() {
    const filterElements = document.querySelectorAll('.card-body select');
    
    filterElements.forEach(function(filter) {
        filter.addEventListener('change', function() {
            filterSubmissions();
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

// Setup feedback form
function setupFeedbackForm() {
    const form = document.getElementById('feedbackForm');
    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            submitFeedback();
        });
    }

    // Score input validation
    const scoreInput = form?.querySelector('input[type="number"]');
    if (scoreInput) {
        scoreInput.addEventListener('input', function() {
            updateGradeFromScore(this.value);
        });
    }

    // Grade select change
    const gradeSelect = form?.querySelector('select[name="grade"]');
    if (gradeSelect) {
        gradeSelect.addEventListener('change', function() {
            updateScoreFromGrade(this.value);
        });
    }
}

// Load submissions data
function loadSubmissions() {
    updateSubmissionStats();
}

// Filter submissions based on criteria
function filterSubmissions() {
    const assignmentFilter = document.querySelector('.card-body select:nth-of-type(1)').value;
    const facultyFilter = document.querySelector('.card-body select:nth-of-type(2)').value;
    const statusFilter = document.querySelector('.card-body select:nth-of-type(3)').value;
    const priorityFilter = document.querySelector('.card-body select:nth-of-type(4)').value;
    
    const submissionItems = document.querySelectorAll('.submission-item');
    
    submissionItems.forEach(function(item) {
        const title = item.querySelector('h6').textContent.toLowerCase();
        const status = item.querySelector('.badge').textContent.toLowerCase();
        
        let showItem = true;
        
        // Assignment filter
        if (assignmentFilter && !title.includes(assignmentFilter.toLowerCase())) {
            showItem = false;
        }
        
        // Status filter
        if (statusFilter && !status.includes(statusFilter.toLowerCase())) {
            showItem = false;
        }
        
        item.style.display = showItem ? '' : 'none';
    });
    
    updateVisibleSubmissionCount();
}

// Update department filter options
function updateDepartmentFilter(faculty) {
    const departmentFilter = document.querySelector('.card-body select:nth-of-type(3)');
    
    // This would typically fetch departments from the server
    // For now, we'll use mock data
    const departments = getDepartmentsByFaculty(faculty);
    
    // Clear and populate
    departmentFilter.innerHTML = '<option value="">All Departments</option>';
    departments.forEach(function(dept) {
        const option = document.createElement('option');
        option.value = dept.value;
        option.textContent = dept.text;
        departmentFilter.appendChild(option);
    });
}

// Update grade based on score
function updateGradeFromScore(score) {
    const gradeSelect = document.querySelector('#feedbackForm select[name="grade"]');
    if (!gradeSelect) return;
    
    let grade = 'F';
    if (score >= 90) grade = 'A';
    else if (score >= 80) grade = 'B';
    else if (score >= 70) grade = 'C';
    else if (score >= 60) grade = 'D';
    
    gradeSelect.value = grade;
}

// Update score based on grade
function updateScoreFromGrade(grade) {
    const scoreInput = document.querySelector('#feedbackForm input[type="number"]');
    if (!scoreInput) return;
    
    const gradeScores = {
        'A': 95,
        'B': 85,
        'C': 75,
        'D': 65,
        'F': 50
    };
    
    scoreInput.value = gradeScores[grade] || 0;
}

// Submit feedback
function submitFeedback() {
    const form = document.getElementById('feedbackForm');
    const formData = new FormData(form);
    
    // Show loading state
    const submitButton = form.querySelector('button[type="submit"]');
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting Feedback...';
    submitButton.disabled = true;
    
    // Simulate API call
    setTimeout(function() {
        // Reset form
        form.reset();
        
        // Reset button
        submitButton.innerHTML = originalText;
        submitButton.disabled = false;
        
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('feedbackModal'));
        modal.hide();
        
        // Show success message
        showNotification('Feedback submitted successfully!', 'success');
        
        // Update submission status
        updateSubmissionStatus();
        
        // Update stats
        updateSubmissionStats();
        updateGradeDistribution();
        
    }, 2000);
}

// Update submission status after feedback
function updateSubmissionStatus() {
    // Find the first pending submission and mark as reviewed
    const pendingSubmission = document.querySelector('.submission-item .badge.bg-warning');
    if (pendingSubmission) {
        pendingSubmission.className = 'badge bg-success';
        pendingSubmission.textContent = 'Reviewed';
        
        // Add rating display
        const submissionItem = pendingSubmission.closest('.submission-item');
        const scoreDisplay = document.createElement('div');
        scoreDisplay.className = 'mt-2';
        scoreDisplay.innerHTML = `
            <div class="d-flex align-items-center">
                <span class="text-muted me-2">Score:</span>
                <div class="rating">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="far fa-star text-muted"></i>
                </div>
                <span class="ms-2 fw-bold">85/100</span>
            </div>
        `;
        
        const contentDiv = submissionItem.querySelector('.flex-grow-1');
        contentDiv.appendChild(scoreDisplay);
    }
}

// Update submission statistics
function updateSubmissionStats() {
    const submissionItems = document.querySelectorAll('.submission-item');
    const pendingSubmissions = document.querySelectorAll('.submission-item .badge.bg-warning').length;
    const reviewedSubmissions = document.querySelectorAll('.submission-item .badge.bg-success').length;
    const flaggedSubmissions = document.querySelectorAll('.submission-item .badge.bg-danger').length;
    
    // Update stat cards
    const statCards = document.querySelectorAll('.card.text-center h4');
    if (statCards[0]) statCards[0].textContent = submissionItems.length;
    if (statCards[1]) statCards[1].textContent = pendingSubmissions;
    if (statCards[2]) statCards[2].textContent = reviewedSubmissions;
    if (statCards[3]) statCards[3].textContent = flaggedSubmissions;
}

// Update grade distribution chart
function updateGradeDistribution() {
    const progressBars = document.querySelectorAll('.grade-distribution .progress-bar');
    
    progressBars.forEach(function(bar) {
        const width = bar.style.width;
        bar.style.width = '0%';
        
        setTimeout(function() {
            bar.style.width = width;
        }, 100);
    });
}

// Update visible submission count
function updateVisibleSubmissionCount() {
    const visibleItems = document.querySelectorAll('.submission-item:not([style*="display: none"])');
    const totalItems = document.querySelectorAll('.submission-item').length;
    
    console.log(`Showing ${visibleItems.length} of ${totalItems} submissions`);
}

// Download submission
function downloadSubmission(button) {
    const submissionItem = button.closest('.submission-item');
    const studentName = submissionItem.querySelector('h6').textContent.split(' - ')[0];
    const fileName = submissionItem.querySelector('small:nth-of-type(2)').textContent.split(' ')[0];
    
    showNotification(`Downloading ${fileName} from ${studentName}...`, 'info');
    
    // Simulate download
    setTimeout(function() {
        showNotification('Download completed!', 'success');
    }, 1500);
}

// Flag submission
function flagSubmission(button) {
    const submissionItem = button.closest('.submission-item');
    const badge = submissionItem.querySelector('.badge');
    const studentName = submissionItem.querySelector('h6').textContent.split(' - ')[0];
    
    if (badge.classList.contains('bg-danger')) {
        // Unflag
        badge.className = 'badge bg-warning';
        badge.textContent = 'Pending Review';
        showNotification(`Submission from ${studentName} unflagged`, 'info');
    } else {
        // Flag
        badge.className = 'badge bg-danger';
        badge.textContent = 'Flagged';
        showNotification(`Submission from ${studentName} flagged for review`, 'warning');
    }
    
    updateSubmissionStats();
}

// Preview submission
function previewSubmission(button) {
    const submissionItem = button.closest('.submission-item');
    const studentName = submissionItem.querySelector('h6').textContent.split(' - ')[0];
    const fileName = submissionItem.querySelector('small:nth-of-type(2)').textContent.split(' ')[0];
    
    showNotification(`Opening preview for ${fileName} from ${studentName}...`, 'info');
    
    // This would typically open a preview modal or new tab
    setTimeout(function() {
        showNotification('Preview functionality coming soon!', 'info');
    }, 1000);
}

// Export grades
function exportGrades() {
    const reviewedSubmissions = document.querySelectorAll('.submission-item .badge.bg-success');
    
    if (reviewedSubmissions.length === 0) {
        showNotification('No graded submissions to export', 'warning');
        return;
    }
    
    const data = [];
    
    reviewedSubmissions.forEach(function(badge) {
        const submissionItem = badge.closest('.submission-item');
        const studentInfo = submissionItem.querySelector('h6').textContent.split(' - ');
        const studentName = studentInfo[0];
        const assignment = studentInfo[1];
        const matricNumber = submissionItem.querySelector('p').textContent.split(' • ')[0];
        const scoreElement = submissionItem.querySelector('.fw-bold');
        const score = scoreElement ? scoreElement.textContent : 'N/A';
        
        data.push({
            student: studentName,
            matricNumber: matricNumber,
            assignment: assignment,
            score: score,
            status: 'Graded'
        });
    });
    
    const csvContent = convertToCSV(data);
    downloadCSV(csvContent, 'grades.csv');
    
    showNotification(`Exported ${data.length} grade(s) successfully`, 'success');
}

// Send feedback emails
function sendFeedbackEmails() {
    const reviewedSubmissions = document.querySelectorAll('.submission-item .badge.bg-success').length;
    
    if (reviewedSubmissions === 0) {
        showNotification('No reviewed submissions to send emails for', 'warning');
        return;
    }
    
    showNotification('Sending feedback emails...', 'info');
    
    setTimeout(function() {
        showNotification(`Feedback emails sent to ${reviewedSubmissions} student(s)`, 'success');
    }, 2000);
}

// Generate report
function generateReport() {
    showNotification('Generating comprehensive feedback report...', 'info');
    
    setTimeout(function() {
        showNotification('Report generated successfully!', 'success');
    }, 3000);
}

// Bulk download all submissions
function bulkDownloadSubmissions() {
    const visibleSubmissions = document.querySelectorAll('.submission-item:not([style*="display: none"])').length;
    
    if (visibleSubmissions === 0) {
        showNotification('No submissions to download', 'warning');
        return;
    }
    
    showNotification(`Preparing ${visibleSubmissions} submission(s) for download...`, 'info');
    
    setTimeout(function() {
        showNotification('All submissions downloaded as ZIP file', 'success');
    }, 3000);
}

// Bulk review functionality
function bulkReview() {
    const pendingSubmissions = document.querySelectorAll('.submission-item .badge.bg-warning').length;
    
    if (pendingSubmissions === 0) {
        showNotification('No pending submissions for bulk review', 'warning');
        return;
    }
    
    showNotification('Bulk review functionality coming soon!', 'info');
}

// Get departments by faculty (shared utility)
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

// Utility functions for CSV export
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

function downloadCSV(csvContent, filename) {
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = filename;
    link.click();
    window.URL.revokeObjectURL(url);
}