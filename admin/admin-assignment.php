<?php
// admin-assignments.php
session_start();
include('../conn/conn.php');

// Protect admin page
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

// Fetch assignments with related course titles (assuming course_id foreign key)
$stmt = $conn->prepare("
    SELECT a.*, c.title AS course_title 
    FROM tbl_assignments a
    LEFT JOIN tbl_courses c ON a.course_id = c.id
    ORDER BY a.due_date ASC
");
$stmt->execute();
$assignments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Assignments - LMS</title>
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
    <h1 class="h5 mb-0">Admin - Manage Assignments</h1>
    <div>
      <a href="../index.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
  </header>

  <!-- Sidebar -->
  <nav class="sidebar">
    <a href="admin-dashboard.php">🏠 Dashboard</a>
    <a href="admin-users.php">👥 Users</a>
    <a href="admin-courses.php">📚 Courses</a>
    <a href="admin-assignment.php" class="active">📝 Assignments</a>
    <a href="admin-progress.php">📊 Progress</a>
    <a href="admin-settings.php">⚙️ Settings</a>
  </nav>

  <!-- Main Content -->
  <main class="main">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Assignments</h2>
      <a href="admin-add-assignment.php" class="btn btn-primary">+ Add New Assignment</a>
    </div>

    <?php if(count($assignments) > 0): ?>
    <div class="card shadow-sm">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Course</th>
              <th>Due Date</th>
              <th>Description</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($assignments as $index => $assignment): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= htmlspecialchars($assignment['title']) ?></td>
              <td><?= htmlspecialchars($assignment['course_title'] ?? 'Unknown') ?></td>
              <td><?= date("M d, Y", strtotime($assignment['due_date'])) ?></td>
              <td><?= htmlspecialchars(strlen($assignment['description']) > 50 ? substr($assignment['description'], 0, 50) . "..." : $assignment['description']) ?></td>
              <td>
                <a href="admin-edit-assignment.php?id=<?= $assignment['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="admin-delete-assignment.php?id=<?= $assignment['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this assignment?')">Delete</a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php else: ?>
      <p class="text-muted">No assignments found. Please add new assignments.</p>
    <?php endif; ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
