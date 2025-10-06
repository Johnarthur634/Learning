<?php
session_start();
include('../conn/conn.php');

// Protect admin page
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

// Example queries — Adjust table/column names as per your schema

// 1. Get overall progress stats (e.g., total users, courses, average progress)
$stmtStats = $conn->query("
    SELECT 
      (SELECT COUNT(*) FROM tbl_user) AS total_users,
      (SELECT COUNT(*) FROM tbl_courses) AS total_courses,
      (SELECT COUNT(*) FROM tbl_assignments) AS total_assignments,
      (SELECT AVG(progress_percentage) FROM tbl_user_progress) AS avg_progress
");
$stats = $stmtStats->fetch(PDO::FETCH_ASSOC);

// 2. Get detailed progress per user per course
$stmtDetails = $conn->prepare("
    SELECT u.username, c.title AS course_title, up.progress_percentage, up.last_access
    FROM tbl_user_progress up
    JOIN tbl_user u ON up.user_id = u.id
    JOIN tbl_courses c ON up.course_id = c.id
    ORDER BY u.username, c.title
");
$stmtDetails->execute();
$progressRecords = $stmtDetails->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Progress - LMS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background-color: #f4f6f9;
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
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="bg-dark text-white p-3 d-flex justify-content-between align-items-center">
    <h1 class="h5 mb-0">Admin - User Progress</h1>
    <div>
      <a href="../index.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
  </header>

  <!-- Sidebar -->
  <nav class="sidebar">
    <a href="admin-dashboard.php">🏠 Dashboard</a>
    <a href="admin-users.php">👥 Users</a>
    <a href="admin-courses.php">📚 Courses</a>
    <a href="admin-assignments.php">📝 Assignments</a>
    <a href="admin-progress.php" class="active">📊 Progress</a>
    <a href="admin-settings.php">⚙️ Settings</a>
  </nav>

  <!-- Main Content -->
  <main class="main">
    <h2>User Progress Overview</h2>

    <!-- Summary Cards -->
    <div class="row g-3 mb-4">
      <div class="col-md-3">
        <div class="card text-center shadow-sm">
          <div class="card-body">
            <h4 class="text-primary"><?= $stats['total_users'] ?? 0 ?></h4>
            <p class="text-muted mb-0">Total Users</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-center shadow-sm">
          <div class="card-body">
            <h4 class="text-success"><?= $stats['total_courses'] ?? 0 ?></h4>
            <p class="text-muted mb-0">Total Courses</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-center shadow-sm">
          <div class="card-body">
            <h4 class="text-warning"><?= $stats['total_assignments'] ?? 0 ?></h4>
            <p class="text-muted mb-0">Total Assignments</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-center shadow-sm">
          <div class="card-body">
            <h4 class="text-danger"><?= round($stats['avg_progress'] ?? 0, 2) ?>%</h4>
            <p class="text-muted mb-0">Average Progress</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Detailed Progress Table -->
    <div class="card shadow-sm">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>User</th>
              <th>Course</th>
              <th>Progress</th>
              <th>Last Access</th>
            </tr>
          </thead>
          <tbody>
            <?php if($progressRecords): ?>
              <?php foreach ($progressRecords as $idx => $rec): ?>
              <tr>
                <td><?= $idx + 1 ?></td>
                <td><?= htmlspecialchars($rec['username']) ?></td>
                <td><?= htmlspecialchars($rec['course_title']) ?></td>
                <td>
                  <div class="progress" style="height: 20px;">
                    <div class="progress-bar" role="progressbar" style="width: <?= (float)$rec['progress_percentage'] ?>%;" aria-valuenow="<?= (float)$rec['progress_percentage'] ?>" aria-valuemin="0" aria-valuemax="100">
                      <?= round($rec['progress_percentage'], 1) ?>%
                    </div>
                  </div>
                </td>
                <td><?= date("M d, Y", strtotime($rec['last_access'])) ?></td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="5" class="text-center text-muted">No progress records found.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
