//registration
// Form validation and submission
document
  .getElementById("registrationForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    // Getting form data
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);

    // Basic validation
    if (
      !data.firstName ||
      !data.lastName ||
      !data.matricNumber ||
      !data.department ||
      !data.faculty
    ) {
      alert("Please fill in all required fields.");
      return;
    }

    // Validate matric number format
    const matricPattern = /^[A-Z]{2,4}\/\d{4}\/\d{3}$/;
    if (!matricPattern.test(data.matricNumber)) {
      alert("Please enter a valid matric number format (e.g., CMP/2023/001)");
      return;
    }

    // Simulating registration success
    alert(
      "Registration successful! Welcome to ClassTrack, " + data.firstName + "!"
    );

    // Sending this data to your server
    // console.log('Registration data:', data);

    // Redirect to login page
    window.location.href = "login.html";
  });

// Real-time validation feedback
const inputs = document.querySelectorAll(".form-control, .form-select");
inputs.forEach((input) => {
  input.addEventListener("blur", function () {
    if (this.value.trim() !== "") {
      this.classList.add("is-valid");
      this.classList.remove("is-invalid");
    } else {
      this.classList.add("is-invalid");
      this.classList.remove("is-valid");
    }    
  });
});
    console.log(inputs);



// login
// Password toggle functionality
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Form validation and submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            // Basic validation
            if (!data.matricNumber || !data.password) {
                alert('Please fill in all required fields.');
                return;
            }
            
            // Validate matric number format
            const matricPattern = /^[A-Z]{2,4}\/\d{4}\/\d{3}$/;
            if (!matricPattern.test(data.matricNumber)) {
                alert('Please enter a valid matric number format (e.g., CMP/2023/001)');
                return;
            }
            
            // Simulate login success
            alert('Login successful! Welcome to ClassTrack!');
            
            // In a real application, you would send this data to your server
            console.log('Login data:', data);
            
            // Redirect to dashboard
            window.location.href = 'index.html';
        });

        // Add real-time validation feedback
        const input = document.querySelectorAll('.form-control');
        input.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() !== '') {
                    this.classList.add('is-valid');
                    this.classList.remove('is-invalid');
                } else {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                }
            });
        });