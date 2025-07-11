//Js file for my IT project

//uploads page
// File upload functionality
document.querySelector('.upload-box input[type="file"]').addEventListener("change", function (e) {
        if (e.target.files.length > 0) {
            const fileName = e.target.files[0].name;
            const uploadText = document.querySelector(".upload-text");
            uploadText.textContent = `Selected: ${fileName}`;
            uploadText.style.color = "#4caf50";
        }
    });

// Drag and drop functionality
const uploadBox = document.querySelector(".upload-box");

uploadBox.addEventListener("dragover", function (e) {
    e.preventDefault();
    uploadBox.style.borderColor = "#1976d2";
    uploadBox.style.backgroundColor = "#e3f2fd";
});

uploadBox.addEventListener("dragleave", function (e) {
    e.preventDefault();
    uploadBox.style.borderColor = "#2196f3";
    uploadBox.style.backgroundColor = "";
});

uploadBox.addEventListener("drop", function (e) {
    e.preventDefault();
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        const fileName = files[0].name;
        const uploadText = document.querySelector(".upload-text");
        uploadText.textContent = `Selected: ${fileName}`;
        uploadText.style.color = "#4caf50";
    }
    uploadBox.style.borderColor = "#2196f3";
    uploadBox.style.backgroundColor = "";
});
// Feedback form submission
const form = document.querySelector("#feedbackForm");
form.addEventListener("submit", function (e) {
    e.preventDefault();

    const studentName = document.getElementById("studentName").value.trim();
    const course = document.getElementById("course").value.trim();
    const feedback = document.getElementById("message").value.trim();

    if (studentName && course && feedback) {
        alert("Feedback submitted successfully!");
        form.reset();
    } else {
        alert("Please fill in all fields.");
    }
});
