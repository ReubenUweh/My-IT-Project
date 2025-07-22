// Student Portal Admin JavaScript

// Initialize the application
document.addEventListener('DOMContentLoaded', function() {
    initializeComponents();
    setupEventListeners();
    updateDashboardStats();
});

// Initialize Bootstrap components and other setup
function initializeComponents() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
}

// Setup event listeners
function setupEventListeners() {
    // Sidebar toggle functionality
    const sidebarToggle = document.querySelector('[data-bs-target="#sidebar"]');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            console.log('Sidebar toggled');
        });
    }

    // Search functionality
    const searchInputs = document.querySelectorAll('input[type="search"]');
    searchInputs.forEach(function(input) {
        input.addEventListener('input', handleSearch);
    });

    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', handleFormSubmit);
    });

    // Table select all functionality
    const selectAllCheckbox = document.getElementById('selectAll');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateBulkActions();
        });
    }

    // Individual checkbox listeners
    const rowCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');
    rowCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', updateBulkActions);
    });
}

// Handle search functionality
function handleSearch(event) {
    const searchTerm = event.target.value.toLowerCase();
    const searchableElements = event.target.closest('.card').querySelectorAll('[data-searchable]');
    
    searchableElements.forEach(function(element) {
        const text = element.textContent.toLowerCase();
        const row = element.closest('tr');
        if (row) {
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
}

// Handle form submission
function handleFormSubmit(event) {
    const form = event.target;
    
    // Basic validation
    if (!form.checkValidity()) {
        // event.preventDefault();
        event.stopPropagation();
        form.classList.add('was-validated');
        return false;
    }

    // Add loading state
    const submitButton = form.querySelector('button[type="submit"]');
    if (submitButton) {
        const originalText = submitButton.innerHTML;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
        submitButton.disabled = true;

        // Simulate processing time (remove in production)
        setTimeout(function() {
            submitButton.innerHTML = originalText;
            submitButton.disabled = false;
            
            // Show success message
            showNotification('Form submitted successfully!', 'success');
            
            // Close modal if form is in a modal
            const modal = form.closest('.modal');
            if (modal) {
                const modalInstance = bootstrap.Modal.getInstance(modal);
                if (modalInstance) {
                    modalInstance.hide();
                }
            }
        }, 2000);
    }

}

// Update bulk actions based on selected checkboxes
function updateBulkActions() {
    const checkedBoxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
    const bulkActions = document.querySelector('.bulk-actions');
    const selectAllCheckbox = document.getElementById('selectAll');
    
    if (bulkActions) {
        if (checkedBoxes.length > 0) {
            bulkActions.style.display = 'block';
        } else {
            bulkActions.style.display = 'none';
        }
    }

    // Update select all checkbox state
    if (selectAllCheckbox) {
        const allCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');
        if (checkedBoxes.length === allCheckboxes.length) {
            selectAllCheckbox.checked = true;
            selectAllCheckbox.indeterminate = false;
        } else if (checkedBoxes.length > 0) {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = true;
        } else {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = false;
        }
    }
}

// Update dashboard statistics (simulate API call)
function updateDashboardStats() {
    const stats = [
        { id: 'totalStudents', value: 1234 },
        { id: 'totalAssignments', value: 87 },
        { id: 'pendingFeedback', value: 23 },
        { id: 'activeFaculties', value: 12 }
    ];

    stats.forEach(function(stat) {
        const element = document.getElementById(stat.id);
        if (element) {
            animateNumber(element, 0, stat.value, 1000);
        }
    });
}

// Animate number counting effect
function animateNumber(element, start, end, duration) {
    const range = end - start;
    const startTime = performance.now();
    
    function updateNumber(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const current = Math.floor(start + (range * progress));
        
        element.textContent = current.toLocaleString();
        
        if (progress < 1) {
            requestAnimationFrame(updateNumber);
        }
    }
    
    requestAnimationFrame(updateNumber);
}

// Show notification/toast
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.top = '80px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.style.minWidth = '300px';
    
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(function() {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// Export data functionality
function exportData(type, format = 'csv') {
    showNotification(`Exporting ${type} data as ${format.toUpperCase()}...`, 'info');
    
    // Simulate export process
    setTimeout(function() {
        showNotification(`${type} data exported successfully!`, 'success');
    }, 2000);
}

// Refresh functions for different sections
function refreshFaculties() {
    showNotification('Refreshing faculties...', 'info');
    setTimeout(function() {
        showNotification('Faculties refreshed successfully!', 'success');
    }, 1000);
}

function refreshDepartments() {
    showNotification('Refreshing departments...', 'info');
    setTimeout(function() {
        showNotification('Departments refreshed successfully!', 'success');
    }, 1000);
}

// Filter functionality
function applyFilters() {
    const filters = document.querySelectorAll('.filter-select');
    const activeFilters = [];
    
    filters.forEach(function(filter) {
        if (filter.value) {
            activeFilters.push({
                name: filter.name,
                value: filter.value
            });
        }
    });
    
    console.log('Applied filters:', activeFilters);
    showNotification(`Applied ${activeFilters.length} filter(s)`, 'info');
}

// Clear all filters
function clearFilters() {
    const filters = document.querySelectorAll('.filter-select');
    filters.forEach(function(filter) {
        filter.value = '';
    });
    
    showNotification('All filters cleared', 'info');
}

// Print functionality
function printPage() {
    window.print();
}

// Keyboard shortcuts
document.addEventListener('keydown', function(event) {
    // Ctrl+S to save (prevent default and show message)
    if (event.ctrlKey && event.key === 's') {
        event.preventDefault();
        showNotification('Use the Save button to save changes', 'warning');
    }
    
    // Escape to close modals
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('.modal.show');
        modals.forEach(function(modal) {
            const modalInstance = bootstrap.Modal.getInstance(modal);
            if (modalInstance) {
                modalInstance.hide();
            }
        });
    }
});

// Utility functions
function formatDate(date) {
    const options = { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    return new Date(date).toLocaleDateString('en-US', options);
}

function formatFileSize(bytes) {
    const sizes = ['B', 'KB', 'MB', 'GB'];
    if (bytes === 0) return '0 B';
    const i = Math.floor(Math.log(bytes) / Math.log(1024));
    return Math.round(bytes / Math.pow(1024, i) * 100) / 100 + ' ' + sizes[i];
}

function getStatusBadgeClass(status) {
    switch (status.toLowerCase()) {
        case 'active':
            return 'bg-success';
        case 'inactive':
            return 'bg-secondary';
        case 'pending':
            return 'bg-warning';
        case 'completed':
            return 'bg-primary';
        case 'overdue':
            return 'bg-danger';
        default:
            return 'bg-secondary';
    }
}

// Global error handler
window.addEventListener('error', function(event) {
    console.error('JavaScript error:', event.error);
    showNotification('An error occurred. Please refresh the page.', 'danger');
});

// Service worker registration (for offline functionality)
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js').then(function(registration) {
        console.log('SW registered:', registration);
    }).catch(function(error) {
        console.log('SW registration failed:', error);
    });
}