<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>LMS Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
  
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
    /* Make calendar height fixed */
    #calendar {
      max-width: 900px;
      margin: 40px auto;
      background: white;
      border-radius: 8px;
      padding: 15px;
      box-shadow: 0 2px 10px rgb(0 0 0 / 0.1);
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="bg-dark text-white p-3 d-flex justify-content-between align-items-center">
    <h1 class="h5 mb-0">Dashboard</h1>
    <div>
      <a href="Profile.php" class="btn btn-outline-light btn-sm me-2">Profile</a>
      <a href="../index.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
  </header>

  <!-- Sidebar -->
  <nav class="sidebar">
    <a href="dashboard.php" class="active">🏠 Dashboard</a>
    <a href="my-courses.html">📚 My Courses</a>
    <a href="assignments.php">📝 Assignments</a>
    <a href="progress.html">📊 Progress</a>
    <a href="settings.php">⚙️ Settings</a>
  </nav>

  <!-- Main Content -->
  <div class="main" style="margin-top: 60px;">
    <h2 class="mb-4">Welcome Back, Student!</h2>
    <p class="text-muted">Here’s an overview of your learning progress.</p>

<div class="row g-3">
  <div class="col-md-6 col-lg-3">
    <a href="my-courses.html" class="text-decoration-none">
      <div class="card shadow-sm text-center hover-shadow" style="cursor:pointer;">
        <div class="card-body">
          <h5 class="card-title">Enrolled Courses</h5>
          <p class="display-6 text-primary">5</p>
        </div>
      </div>
    </a>
  </div>

  <div class="col-md-6 col-lg-3">
    <a href="assignments.php" class="text-decoration-none">
      <div class="card shadow-sm text-center hover-shadow" style="cursor:pointer;">
        <div class="card-body">
          <h5 class="card-title">Completed Assignments</h5>
          <p class="display-6 text-success">12</p>
        </div>
      </div>
    </a>
  </div>

  <div class="col-md-6 col-lg-3">
    <div class="card shadow-sm text-center">
      <div class="card-body">
        <h5 class="card-title">Progress</h5>
        <p class="display-6 text-warning">65%</p>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3">
    <a href="deadlines.php" class="text-decoration-none">
      <div class="card shadow-sm text-center hover-shadow" style="cursor:pointer;">
        <div class="card-body">
          <h5 class="card-title">Upcoming Deadlines</h5>
          <p class="display-6 text-danger">2</p>
        </div>
      </div>
    </a>
  </div>
</div>

    <!-- Calendar -->
    <div id="calendar"></div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- FullCalendar JS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 600,
        events: [
          { title: 'Assignment 1 Due', date: '2025-10-10' },
          { title: 'Course Project', date: '2025-10-15' },
          { title: 'Exam', date: '2025-10-20' },
          // Add more events as needed
        ],
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        }
      });
      calendar.render();
    });
  </script>
</body>
</html>
