<?php
session_start();
include('../conn/conn.php');

$user_id = $_SESSION['login_user']?? 5;
// Fetch user data
$stmt = $conn->prepare("SELECT first_name, last_name, username, email, contact_number FROM tbl_user WHERE user_id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$user) {
    die('User not found.');
}

// Handle profile picture upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_photo'])) {
    if ($_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $filename = time() . "_" . basename($_FILES["profile_photo"]["name"]);
        $target_dir = "uploads/";
        $target = $target_dir . $filename;

        // Optional: Validate file type and size here (for security)

        if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target)) {
            // Update database with new profile picture filename
            $sql = "UPDATE tbl_user SET Profile = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$filename, $user_id]);

            // Update $user array to immediately show new profile picture
            $user['Profile'] = $filename;
        }
    }
}

// Prepare profile image path, fallback to default.png if missing
$profile_img = (!empty($user['Profile']) && file_exists("uploads/" . $user['Profile']))
               ? $user['Profile']
               : 'default.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profile - LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: #f8f9fa;
            margin: 0;
        }
        /* Sidebar Styling */
        .sidebar {
            width: 220px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background: #343a40;
            padding-top: 60px;
            overflow-y: auto;
        }
        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 12px 20px;
            transition: background-color 0.3s;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background: #495057;
        }
        /* Main Content Styling */
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
        /* Profile Image Styling */
        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #0d6efd;
        }
        /* Form Input Disable */
        .form-control[readonly] {
            background-color: #e9ecef;
            opacity: 1;
        }
    </style>
</head>
<body>

<!-- Header -->
<header class="bg-dark text-white p-3 d-flex justify-content-between align-items-center">
    <h1 class="h5 mb-0">Profile</h1>
    <div>
        <a href="settings.php" class="btn btn-outline-light btn-sm me-2">Settings</a>
        <a href="../index.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</header>

<!-- Sidebar Navigation -->
<nav class="sidebar">
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="my-courses.html">📚 My Courses</a>
    <a href="assignments.php">📝 Assignments</a>
    <a href="progress.html">📊 Progress</a>
    <a href="settings.php">⚙️ Settings</a>
    <a href="profile.php" class="active">👤 Profile</a>
</nav>

<!-- Main Content Area -->
<main class="main">
    <h2>Student Profile</h2>

    <!-- Profile Card -->
    <div class="card mb-4 shadow-sm d-flex flex-column flex-md-row align-items-center">
        <div class="me-md-4 text-center mb-3 mb-md-0 p-4">
            <img src="uploads/<?php echo htmlspecialchars($profile_img); ?>" 
                 class="profile-img mb-3" alt="Profile Picture" />
            
            <!-- Profile Photo Upload Form -->
            <form method="post" enctype="multipart/form-data">
                <div class="mb-2">
                    <input class="form-control form-control-sm" type="file" name="profile_photo" accept="image/*" />
                </div>
                <button type="submit" class="btn btn-primary btn-sm w-100">Upload</button>
            </form>
        </div>

        <!-- User Information -->
        <div class="p-4 flex-grow-1">
            <h4><?php echo htmlspecialchars(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')); ?></h4>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email'] ?? ''); ?></p>
            <p><strong>Contact:</strong> <?php echo htmlspecialchars($user['contact_number'] ?? ''); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address'] ?? ''); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username'] ?? ''); ?></p>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h4 class="text-primary">8</h4>
                    <p class="text-muted mb-0">Active Courses</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h4 class="text-success">15</h4>
                    <p class="text-muted mb-0">Assignments Submitted</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h4 class="text-warning">92%</h4>
                    <p class="text-muted mb-0">Average Progress</p>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
