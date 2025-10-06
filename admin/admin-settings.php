<?php
session_start();
include('../conn/conn.php');

// Check admin session
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

// Search logic
$search = $_GET['search'] ?? '';

if (!empty($search)) {
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE 
        first_name LIKE :term OR 
        last_name LIKE :term OR 
        email LIKE :term OR 
        username LIKE :term");
    $stmt->execute([':term' => "%$search%"]);
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_user");
    $stmt->execute();
}
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - User Settings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .content-box {
            margin-top: 80px;
        }
    </style>
</head>
<body>

<header class="bg-dark text-white p-3 d-flex justify-content-between align-items-center">
    <h1 class="h5 mb-0">User Management</h1>
    <div>
        <a href="../index.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</header>

<nav class="sidebar">
    <a href="admin-dashboard.php">🏠 Dashboard</a>
    <a href="admin-users.php">👥 Users</a>
    <a href="admin-courses.php">📚 Courses</a>
    <a href="admin-assignments.php">📝 Assignments</a>
    <a href="admin-progress.php">📊 Progress</a>
    <a href="admin-settings.php" class="active">⚙️ Manage</a>
</nav>

<main class="main content-box">
    <h2 class="mb-4">Manage Users</h2>

    <form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name, email, username" value="<?= htmlspecialchars($search) ?>">
            <button class="btn btn-dark" type="submit">Search</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>User ID</th>
                    <th>First</th>
                    <th>Last</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!$users): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">No users found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['user_id'] ?></td>
                        <td><?= htmlspecialchars($user['first_name']) ?></td>
                        <td><?= htmlspecialchars($user['last_name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['password']) ?></td>
                        <td><?= htmlspecialchars($user['contact_number']) ?></td>
                        <td>
                            <button 
                                class="btn btn-sm btn-warning edit-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#editUserModal"
                                data-user='<?= json_encode($user) ?>'
                            >
                                Edit
                            </button>
                            <a href="delete-user.php?user_id=<?= $user['user_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
            </tbody>
        </table>
    </div>
</main>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="../endpoint/update-user.php" class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editUserModalLabel">Edit User</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="user_id" id="edit-user-id">

          <div class="mb-2">
              <label for="edit-first-name" class="form-label">First Name</label>
              <input type="text" class="form-control" id="edit-first-name" name="first_name" required>
          </div>
          <div class="mb-2">
              <label for="edit-last-name" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="edit-last-name" name="last_name" required>
          </div>
          <div class="mb-2">
              <label for="edit-email" class="form-label">Email</label>
              <input type="email" class="form-control" id="edit-email" name="email" required>
          </div>
          <div class="mb-2">
              <label for="edit-username" class="form-label">Username</label>
              <input type="text" class="form-control" id="edit-username" name="username" required>
          </div>
                    <div class="mb-2">
              <label for="edit-password" class="form-label">New Password</label>
              <input type="password" class="form-control" id="edit-password" name="password" placeholder="Leave blank to keep current password">
          </div>
          <div class="mb-2">
              <label for="edit-contact" class="form-label">Contact</label>
              <input type="text" class="form-control" id="edit-contact" name="contact_number">
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" >Update User</button>
      </div>
      </div>
                </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const user = JSON.parse(button.getAttribute('data-user'));

            document.getElementById('edit-user-id').value = user.user_id;
            document.getElementById('edit-first-name').value = user.first_name;
            document.getElementById('edit-last-name').value = user.last_name;
            document.getElementById('edit-email').value = user.email;
            document.getElementById('edit-username').value = user.username;
            document.getElementById('edit-password').value = user.username;
            document.getElementById('edit-contact').value = user.contact_number;
        });
    });
});
</script>

</body>
</html>
