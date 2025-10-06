<?php
include('../conn/conn.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        echo "<script>alert('Please enter both username and password.'); window.location.href = '../index.php';</script>";
        exit;
    }

    // Function to check login for a given table
    function checkLogin($conn, $table, $username, $password) {
        $stmt = $conn->prepare("SELECT * FROM $table WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Compare plain text passwords (or use password_verify if hashed)
            if ($password === $user['password']) {
                return $user;
            }
        }

        return false;
    }

    // Check user table
    $user = checkLogin($conn, 'tbl_user', $username, $password);
    $role = 'user';

    // If not found, check admin table
    if (!$user) {
        $user = checkLogin($conn, 'admin_user', $username, $password);
        $role = 'admin';
    }

    // Redirect based on role
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['admin_user'] = $user['username'];
        $_SESSION['user_role'] = $role;

        if ($role === 'admin') {
            echo "
             <script>
                    alert('Welcome, admin!');
                    window.location.href = 'http://localhost/login/admin/admin-dashboard.php';
                </script>
            ";
        } if ($role === 'user') {
            echo "
                <script>
                    alert('Login Successfully!');
                    window.location.href = 'http://localhost/login/user/dashboard.php';
                </script>
            ";
        }
    } else {
        echo "
            <script>
                alert('Login Failed. Invalid username or password.');
                window.location.href = 'http://localhost/login/index.php';
            </script>
        ";
    }
}
?>

