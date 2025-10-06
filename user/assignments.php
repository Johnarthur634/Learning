<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignments - LMS</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <h1 class="h5 mb-0">Assignments</h1>
    <div>
      <a href="profile.php" class="btn btn-outline-light btn-sm me-2">Profile</a>
      <a href="index.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
  </header>

  <!-- Sidebar -->
  <nav class="sidebar">
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="my-courses.html">📚 My Courses</a>
    <a href="assignments.php" class="active">📝 Assignments</a>
    <a href="progress.html">📊 Progress</a>
    <a href="settings.php">⚙️ Settings</a>
  </nav>

  <!-- Main Content -->
  <div class="main" style="margin-top: 60px;">
    <h2 class="mb-3">My Assignments</h2>
    <p class="text-muted">Track your pending, submitted, and graded assignments here.</p>

    <div class="card shadow-sm">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-dark">
            <tr>
              <th>Assignment</th>
              <th>Course</th>
              <th>Due Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
  <tr data-link="submit-assignment.php?id=1">
    <td>HTML Basics Project</td>
    <td>Web Development</td>
    <td>Oct 10, 2025</td>
    <td><span class="badge bg-warning text-dark">Pending</span></td>
    <td><a href="submit-assignment.php?id=1" class="btn btn-sm btn-primary" onclick="event.stopPropagation()">Submit</a></td>
  </tr>
  <tr data-link="view-assignment.php?id=2">
    <td>Python Data Analysis</td>
    <td>Data Science</td>
    <td>Sep 28, 2025</td>
    <td><span class="badge bg-info text-dark">Submitted</span></td>
    <td><a href="view-assignment.php?id=2" class="btn btn-sm btn-success" onclick="event.stopPropagation()">View</a></td>
  </tr>
  <tr data-link="view-assignment.php?id=3">
    <td>Cybersecurity Report</td>
    <td>Cybersecurity</td>
    <td>Sep 20, 2025</td>
    <td><span class="badge bg-success">Graded (85%)</span></td>
    <td><a href="view-assignment.php?id=3" class="btn btn-sm btn-success" onclick="event.stopPropagation()">View</a></td>
  </tr>
</tbody>

        </table>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">

  document.querySelectorAll('tbody tr').forEach(row => {
    row.style.cursor = 'pointer';
    row.addEventListener('click', () => {
      window.location = row.getAttribute('data-link');
    });
  });

  </script>
</body>
</html>
