<?php include("./conn/conn.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f4f6f9;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            max-width: 700px;
            width: 100%;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
        }

        .switch-form-link {
            cursor: pointer;
            color: #0d6efd;
            text-decoration: underline;
        }

        .checkbox-group {
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .checkbox-group label {
            margin-left: 5px;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="card p-4">
        <h3 class="text-center mb-4">Learning Management System</h3>

        <!-- Login Form -->
        <div class="form-section active" id="loginForm">
            <form action="./endpoint/login.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <p class="text-center mt-3">
                    No account? <span class="switch-form-link" onclick="showRegistrationForm()">Register</span>
                </p>
            </form>
        </div>

        <!-- Registration Form -->
        <div class="form-section" id="registrationForm">
            <form action="./endpoint/add-user.php" method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="contactNumber" class="form-label">Contact Number:</label>
                        <input type="text" class="form-control" id="contactNumber" name="contact_number" maxlength="11" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="registerAddress" class="form-label">Address:</label>
                    <input type="text" class="form-control" id="registerAddress" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="registerUsername" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="registerUsername" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="registerPassword" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="registerPassword" name="password" required>
                </div>
                <div class="checkbox-group mb-3">
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" id="termsCheckbox" required>
                        <label class="form-check-label ms-2" for="termsCheckbox">
                            I accept the <a href="terms.php">Terms</a> & <a href="privacy.php">Privacy Policy</a>
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100" name="register">Register</button>
                <p class="text-center mt-3">
                    Already have an account? <span class="switch-form-link" onclick="showLoginForm()">Login</span>
                </p>
            </form>
        </div>

    </div>
</div>

<script>
    function showLoginForm() {
        document.getElementById("loginForm").classList.add("active");
        document.getElementById("registrationForm").classList.remove("active");
    }

    function showRegistrationForm() {
        document.getElementById("loginForm").classList.remove("active");
        document.getElementById("registrationForm").classList.add("active");
    }
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
