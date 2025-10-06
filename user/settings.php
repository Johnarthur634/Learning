<?php
session_start();
include('../conn/conn.php');

$user_id = $_SESSION['login_user']?? 6;
// Fetch user data
$stmt = $conn->prepare("SELECT first_name, last_name, username, email, contact_number FROM tbl_user WHERE user_id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$user) {
    die('User not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Settings - LMS</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
  body {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }
  .sidebar {
    min-width: 220px;
    max-width: 220px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #343a40;
    padding-top: 60px;
  }
  .sidebar a {
    color: #fff;
    text-decoration: none;
    display: block;
    padding: 12px 20px;
  }
  .sidebar a:hover, .sidebar a.active {
    background-color: #495057;
  }
  .main {
    margin-left: 220px;
    padding: 50px;
    flex: 1;
  }
  header {
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
  }
</style>
</head>
<body>

<!-- Header -->
<header class="bg-dark text-white p-3 d-flex justify-content-between align-items-center">
  <h1 class="h5 mb-0">Settings</h1>
  <div>
    <a href="profile.php" class="btn btn-outline-light btn-sm me-2">Profile</a>
    <a href="../index.php" class="btn btn-danger btn-sm">Logout</a>
  </div>
</header>

<!-- Sidebar -->
<nav class="sidebar">
  <a href="dashboard.php">🏠 Dashboard</a>
  <a href="my-courses.html">📚 My Courses</a>
  <a href="assignments.php">📝 Assignments</a>
  <a href="progress.html">📊 Progress</a>
  <a href="settings.php" class="active">⚙️ Settings</a>
</nav>

<!-- Main Content -->
<div class="main">
  <h2>Account Settings</h2>

  <div class="card mb-4">
    <div class="card-header">Profile Information</div>
    <div class="card-body">
      <form action="../endpoint/update-email.php" method="POST">
        <div class="mb-3">
          <label for="first_name" class="form-label">First Name</label>
          <input type="text" id="first_name" class="form-control" value="<?= htmlspecialchars($user['first_name']) ?>" disabled />
        </div>
        <div class="mb-3">
          <label for="last_name" class="form-label">Last Name</label>
          <input type="text" id="last_name" class="form-control" value="<?= htmlspecialchars($user['last_name']) ?>" disabled />
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" id="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" disabled />
        </div>
        <div class="mb-3">
          <label for="contact_number" class="form-label">Contact Number</label>
          <input type="text" id="contact_number" class="form-control" value="<?= htmlspecialchars($user['contact_number']) ?>" disabled />
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input
            type="email"
            id="email"
            name="email"
            class="form-control"
            value="<?= htmlspecialchars($user['email']) ?>"
            required
          />
        </div>

        <button type="submit" class="btn btn-primary">Update Email</button>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
