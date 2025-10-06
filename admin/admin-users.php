<?php
// admin-users.php
include('../conn/conn.php');
session_start();

// Fetch users from the database
$stmt = $conn->prepare("SELECT user_id, username, email, created_at FROM tbl_user ORDER BY created_at DESC");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Users - LMS Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
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
  <h1 class="h5 mb-0">Admin - Manage Users</h1>
  <div>
    <a href="index.php" class="btn btn-danger btn-sm">Logout</a>
  </div>
</header>

<!-- Sidebar -->
<nav class="sidebar">
  <a href="admin-dashboard.php">🏠 Dashboard</a>
  <a href="admin-users.php" class="active">👥 Users</a>
  <a href="admin-courses.php">📚 Courses</a>
  <a href="admin-assignment.php">📝 Assignments</a>
  <a href="admin-progress.php">📊 Progress</a>
  <a href="admin-settings.php">⚙️ Settings</a>
</nav>

<!-- Main Content -->
<main class="main">
  <h2 class="mb-4">Registered Users</h2>

  <!-- Add User Button -->
  <div class="mb-3 text-end">
    <a href="admin-add-user.php" class="btn btn-primary">➕ Add New User</a>
  </div>

  <!-- User Table -->
  <div class="card shadow-sm">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Username</th>
            <th>Email</th>
            <th>Registered</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($users) > 0): ?>
            <?php foreach ($users as $index => $user): ?>
<tr>
  <td><?= $index + 1 ?></td>
  <td><?= htmlspecialchars($user['username']) ?></td>
  <td><?= htmlspecialchars($user['email']) ?></td>
  <td><?= date("M d, Y", strtotime($user['created_at'])) ?></td>
  <td>
<a href="edit-user.php?id=<?= $row['user_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
<a href="delete-user.php?id=<?= $row['user_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
  </td>
</tr>

            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center text-muted">No users found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
