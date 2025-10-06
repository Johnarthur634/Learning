<?php
// admin-dashboard.php
session_start();
include('../conn/conn.php');

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Fetch accurate stats from DB

// Total users
$stmt = $conn->query("SELECT COUNT(*) FROM tbl_user");
$stats['total_users'] = $stmt->fetchColumn();

// Total courses
$stmt = $conn->query("SELECT COUNT(*) FROM tbl_user");
$stats['total_user'] = $stmt->fetchColumn();

// Total assignments
$stmt = $conn->query("SELECT COUNT(*) FROM tbl_user");
$stats['total_user'] = $stmt->fetchColumn();

// Active users - users logged in within last 30 days (adjust column name accordingly)
$stmt = $conn->prepare("SELECT COUNT(*) FROM tbl_user WHERE last_login >= DATE_SUB(NOW(), INTERVAL 30 DAY)");
$stmt->execute();
$stats['active_users'] = $stmt->fetchColumn();

// Example recent activity (replace with dynamic DB data if available)
$activities = [
    "John Doe enrolled in Web Development",
    "Jane Smith submitted an assignment",
    "New course 'Python Basics' added"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard - LMS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background-color: #f8f9fa;
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
      font-weight: 500;
    }
    .sidebar a:hover, .sidebar a.active {
      background-color: #495057;
    }
    .main {
      margin-left: 220px;
      padding: 20px;
      flex: 1;
      margin-top: 60px;
    }
    header {
      position: fixed;
      width: 100%;
      top: 0;
      left: 0;
      z-index: 1000;
      background-color: #212529;
    }
    .card:hover {
      box-shadow: 0 0 15px rgba(0,0,0,0.15);
      transition: box-shadow 0.3s ease-in-out;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="bg-dark text-white p-3 d-flex justify-content-between align-items-center">
    <h1 class="h5 mb-0">Admin Dashboard</h1>
    <div>
      <a href="../index.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
  </header>

  <!-- Sidebar -->
  <nav class="sidebar">
    <a href="admin-dashboard.php" class="active">🏠 Dashboard</a>
    <a href="admin-users.php">👥 Users</a>
    <a href="admin-courses.php">📚 Courses</a>
    <a href="admin-assignments.php">📝 Assignments</a>
    <a href="admin-progress.php">📊 Progress</a>
    <a href="admin-settings.php">⚙️ Settings</a>
  </nav>

  <!-- Main Content -->
  <main class="main">
    <h2 class="mb-4">Overview</h2>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
      <div class="col-md-3">
        <a href="admin-users.php" class="text-decoration-none">
          <div class="card text-center shadow-sm" style="cursor:pointer;">
            <div class="card-body">
              <h4 class="text-primary"><?= $stats['total_users']; ?></h4>
              <p class="text-muted mb-0">Total Users</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-3">
        <a href="admin-courses.php" class="text-decoration-none">
          <div class="card text-center shadow-sm" style="cursor:pointer;">
            <div class="card-body">
              <h4 class="text-success"><?= $stats['total_courses']; ?></h4>
              <p class="text-muted mb-0">Courses</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-3">
        <a href="admin-assignments.php" class="text-decoration-none">
          <div class="card text-center shadow-sm" style="cursor:pointer;">
            <div class="card-body">
              <h4 class="text-warning"><?= $stats['total_assignments']; ?></h4>
              <p class="text-muted mb-0">Assignments</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-3">
        <a href="admin-progress.php" class="text-decoration-none">
          <div class="card text-center shadow-sm" style="cursor:pointer;">
            <div class="card-body">
              <h4 class="text-danger"><?= $stats['active_users']; ?></h4>
              <p class="text-muted mb-0">Active Users</p>
            </div>
          </div>
        </a>
      </div>
    </div>

    <!-- Recent Activity Table -->
    <h3 class="mb-3">Recent Activity</h3>
    <div class="card shadow-sm">
      <div class="card-body p-0">
        <table class="table mb-0">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Activity</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($activities as $index => $activity): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= htmlspecialchars($activity) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
