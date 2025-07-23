//Settings Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    initializeSettingsPage();
});

function initializeSettingsPage() {
    setupTabNavigation();
    setupFormHandlers();
    loadSettingsData();
    setupFileUploads();
    setupPasswordStrengthChecker();
}

// Setup tab navigation
function setupTabNavigation() {
    const tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
    
    tabLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            
            // Remove active class from all tabs and content
            document.querySelectorAll('.list-group-item').forEach(item => item.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('show', 'active'));
            
            // Add active class to clicked tab
            this.classList.add('active');
            
            // Show corresponding content
            const targetId = this.getAttribute('href').substring(1);
            const targetPane = document.getElementById(targetId);
            if (targetPane) {
                targetPane.classList.add('show', 'active');
            }
        });
    });
}

// Setup form handlers
function setupFormHandlers() {
    const forms = document.querySelectorAll('.tab-content form');
    
    forms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            handleSettingsSubmit(this);
        });
    });

    // Handle checkbox changes
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.id !== 'twoFactorAuth') {
                autoSaveSetting(this.id, this.checked);
            }
        });
    });

    // Handle select changes
    const selects = document.querySelectorAll('select');
    selects.forEach(function(select) {
        select.addEventListener('change', function() {
            autoSaveSetting(this.id || this.name, this.value);
        });
    });
}

// Setup file upload handlers
function setupFileUploads() {
    const fileInputs = document.querySelectorAll('input[type="file"]');
    
    fileInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            handleFileUpload(this);
        });
    });
}

// Setup password strength checker
function setupPasswordStrengthChecker() {
    const passwordInput = document.querySelector('input[type="password"][placeholder*="New"]');
    
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            checkPasswordStrength(this.value);
        });
    }
}

// Handle settings form submission
function handleSettingsSubmit(form) {
    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');
    
    // Show loading state
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
    submitButton.disabled = true;
    
    // Determine which settings category is being saved
    const tabPane = form.closest('.tab-pane');
    const settingsType = tabPane ? tabPane.id : 'general';
    
    // Simulate API call
    setTimeout(function() {
        // Reset button
        submitButton.innerHTML = originalText;
        submitButton.disabled = false;
        
        // Show success message
        showNotification(`${capitalizeFirst(settingsType)} settings saved successfully!`, 'success');
        
        // Handle specific setting types
        handleSpecificSettings(settingsType, formData);
        
    }, 1500);
}

// Handle specific setting updates
function handleSpecificSettings(type, formData) {
    switch (type) {
        case 'security':
            handleSecuritySettings(formData);
            break;
        case 'notifications':
            handleNotificationSettings(formData);
            break;
        case 'appearance':
            handleAppearanceSettings(formData);
            break;
        case 'backup':
            handleBackupSettings(formData);
            break;
        default:
            handleGeneralSettings(formData);
    }
}

// Handle general settings
function handleGeneralSettings(formData) {
    const institutionName = formData.get('institutionName');
    if (institutionName) {
        // Update navbar brand
        const navbarBrand = document.querySelector('.navbar-brand');
        if (navbarBrand) {
            navbarBrand.innerHTML = `<i class="fas fa-graduation-cap me-2"></i>${institutionName}`;
        }
    }
}

// Handle security settings
function handleSecuritySettings(formData) {
    const currentPassword = formData.get('currentPassword');
    const newPassword = formData.get('newPassword');
    const confirmPassword = formData.get('confirmPassword');
    
    if (newPassword && confirmPassword) {
        if (newPassword !== confirmPassword) {
            showNotification('New passwords do not match!', 'danger');
            return;
        }
        
        if (newPassword.length < 8) {
            showNotification('Password must be at least 8 characters long!', 'warning');
            return;
        }
        
        showNotification('Password changed successfully!', 'success');
    }
}

// Handle notification settings
function handleNotificationSettings(formData) {
    const enabledNotifications = [];
    
    formData.forEach(function(value, key) {
        if (value === 'on') {
            enabledNotifications.push(key);
        }
    });
    
    console.log('Enabled notifications:', enabledNotifications);
}

// Handle appearance settings
function handleAppearanceSettings(formData) {
    const language = formData.get('language');
    const dateFormat = formData.get('dateFormat');
    const itemsPerPage = formData.get('itemsPerPage');
    
    if (itemsPerPage) {
        updatePaginationSettings(itemsPerPage);
    }
    
    console.log('Appearance settings:', { language, dateFormat, itemsPerPage });
}

// Handle backup settings
function handleBackupSettings(formData) {
    const autoBackup = formData.get('autoBackup');
    const retentionPeriod = formData.get('retentionPeriod');
    
    console.log('Backup settings:', { autoBackup, retentionPeriod });
}

// Auto-save individual settings
function autoSaveSetting(settingName, value) {
    console.log(`Auto-saving: ${settingName} = ${value}`);
    
    // Show subtle notification for auto-save
    showNotification(`${settingName} updated`, 'info', 2000);
}

// Handle file upload
function handleFileUpload(input) {
    const file = input.files[0];
    
    if (!file) return;
    
    // Validate file size (2MB limit)
    if (file.size > 2 * 1024 * 1024) {
        showNotification('File size must be less than 2MB', 'warning');
        input.value = '';
        return;
    }
    
    // Validate file type for logo upload
    if (input.accept && input.accept.includes('image/')) {
        if (!file.type.startsWith('image/')) {
            showNotification('Please select a valid image file', 'warning');
            input.value = '';
            return;
        }
    }
    
    showNotification('File uploaded successfully!', 'success');
    
    // Preview image if it's a logo upload
    if (file.type.startsWith('image/')) {
        previewImage(file, input);
    }
}

// Preview uploaded image
function previewImage(file, input) {
    const reader = new FileReader();
    
    reader.onload = function(e) {
        // Create or update preview
        let preview = input.parentElement.querySelector('.image-preview');
        if (!preview) {
            preview = document.createElement('div');
            preview.className = 'image-preview mt-2';
            input.parentElement.appendChild(preview);
        }
        
        preview.innerHTML = `
            <img src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
            <small class="d-block text-muted">${file.name}</small>
        `;
    };
    
    reader.readAsDataURL(file);
}

// Check password strength
function checkPasswordStrength(password) {
    const strengthIndicator = getOrCreatePasswordStrengthIndicator();
    
    if (!password) {
        strengthIndicator.style.display = 'none';
        return;
    }
    
    const strength = calculatePasswordStrength(password);
    updatePasswordStrengthDisplay(strengthIndicator, strength);
}

// Get or create password strength indicator
function getOrCreatePasswordStrengthIndicator() {
    let indicator = document.getElementById('passwordStrength');
    
    if (!indicator) {
        indicator = document.createElement('div');
        indicator.id = 'passwordStrength';
        indicator.className = 'password-strength mt-2';
        
        const passwordInput = document.querySelector('input[type="password"][placeholder*="New"]');
        passwordInput.parentElement.appendChild(indicator);
    }
    
    return indicator;
}

// Calculate password strength
function calculatePasswordStrength(password) {
    let score = 0;
    const checks = {
        length: password.length >= 8,
        lowercase: /[a-z]/.test(password),
        uppercase: /[A-Z]/.test(password),
        numbers: /\d/.test(password),
        symbols: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)
    };
    
    Object.values(checks).forEach(check => {
        if (check) score++;
    });
    
    return {
        score: score,
        checks: checks,
        level: score < 2 ? 'weak' : score < 4 ? 'medium' : 'strong'
    };
}

// Update password strength display
function updatePasswordStrengthDisplay(indicator, strength) {
    const colors = {
        weak: 'danger',
        medium: 'warning',
        strong: 'success'
    };
    
    const percentage = (strength.score / 5) * 100;
    
    indicator.style.display = 'block';
    indicator.innerHTML = `
        <div class="progress" style="height: 5px;">
            <div class="progress-bar bg-${colors[strength.level]}" style="width: ${percentage}%"></div>
        </div>
        <small class="text-${colors[strength.level]}">
            Password strength: ${strength.level.toUpperCase()}
        </small>
    `;
}

// Load settings data
function loadSettingsData() {
    // This would typically fetch from an API
    // For now, we'll set some default values
    
    // General settings
    document.querySelector('input[value="University of Excellence"]').value = 'University of Excellence';
    
    // Notification settings - check some boxes by default
    const defaultNotifications = ['emailNewSubmission', 'emailDeadlineReminder', 'systemUpdates', 'securityAlerts', 'loginNotifications'];
    defaultNotifications.forEach(function(id) {
        const checkbox = document.getElementById(id);
        if (checkbox) {
            checkbox.checked = true;
        }
    });
    
    console.log('Settings data loaded');
}

// Update pagination settings
function updatePaginationSettings(itemsPerPage) {
    // This would update pagination across the application
    console.log(`Updated pagination to show ${itemsPerPage} items per page`);
}

// Export data functions
function exportStudentData() {
    showNotification('Exporting student data...', 'info');
    setTimeout(() => showNotification('Student data exported successfully!', 'success'), 2000);
}

function exportAssignmentData() {
    showNotification('Exporting assignment data...', 'info');
    setTimeout(() => showNotification('Assignment data exported successfully!', 'success'), 2000);
}

function exportFeedbackData() {
    showNotification('Exporting feedback data...', 'info');
    setTimeout(() => showNotification('Feedback data exported successfully!', 'success'), 2000);
}

function exportFacultyStructure() {
    showNotification('Exporting faculty structure...', 'info');
    setTimeout(() => showNotification('Faculty structure exported successfully!', 'success'), 2000);
}

// Backup functions
function createManualBackup() {
    const button = event.target;
    const originalText = button.innerHTML;
    
    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating Backup...';
    button.disabled = true;
    
    setTimeout(function() {
        button.innerHTML = originalText;
        button.disabled = false;
        showNotification('Manual backup created successfully!', 'success');
    }, 3000);
}

// Two-factor authentication toggle
function toggleTwoFactorAuth() {
    const checkbox = document.getElementById('twoFactorAuth');
    
    if (checkbox.checked) {
        // Show setup modal or instructions
        showNotification('Two-factor authentication setup initiated. Check your email for instructions.', 'info');
    } else {
        if (confirm('Are you sure you want to disable two-factor authentication?')) {
            showNotification('Two-factor authentication disabled', 'warning');
        } else {
            checkbox.checked = true;
        }
    }
}

// Add event listener for 2FA checkbox
document.addEventListener('DOMContentLoaded', function() {
    const twoFactorCheckbox = document.getElementById('twoFactorAuth');
    if (twoFactorCheckbox) {
        twoFactorCheckbox.addEventListener('change', toggleTwoFactorAuth);
    }
});

// Utility function to capitalize first letter
function capitalizeFirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// Enhanced notification function with duration
function showNotification(message, type = 'info', duration = 5000) {
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
    
    // Auto remove after specified duration
    setTimeout(function() {
        if (notification.parentNode) {
            notification.remove();
        }
    }, duration);
}