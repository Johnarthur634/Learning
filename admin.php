<?php include("./conn/conn.php")?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header bg-dark text-white text-center">
          <h4>Admin Registration</h4>
        </div>
        <div class="card-body">
          <form action="./endpoint/admin-user.php" method="POST">
            <div class="mb-3">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" class="form-control" id="firstName" name="first_name" required>
            </div>
            <div class="mb-3">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="lastName" name="last_name" required>
            </div>
            <div class="mb-3">
              <label for="contactNumber" class="form-label">Contact Number</label>
              <input type="text" class="form-control" id="contactNumber" name="contact_number" maxlength="15">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" required minlength="6">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required minlength="">
            </div>

            <!-- Hidden field to set role to admin -->
            <input type="hidden" name="role" value="admin">

            <button type="submit" class="btn btn-dark w-100" name="registers">Register Admin</button>
          </form>
        </div>
        <div class="card-footer text-center text-muted">
          Already have an account? <a href="./index.php">Login</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
