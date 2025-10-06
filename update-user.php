<?php
include ('../conn/conn.php');

$updateUserID = $_POST['user_id'];
$updateFirstName = $_POST['first_name'];
$updateLastName = $_POST['last_name'];
$updateContactNumber = $_POST['contact_number'];
$updateEmail = $_POST['email'];
$updateUsername = $_POST['username'];
$updatePassword = $_POST['password'];

try {
    $stmt = $conn->prepare("SELECT `first_name`, `last_name`, 'email', 'password' FROM `tbl_user` WHERE `first_name` = :first_name AND `last_name` = :last_name AND 'email' = :email AND 'password' = :password");
    $stmt->execute([
        'first_name' => $updateFirstName,
        'last_name'=> $updateLastName,
        'email'=>$updateEmail,
        'password'=>$updatePassword
    ]);
    $nameExist = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($nameExist)) {
        $conn->beginTransaction();

        $updateStmt = $conn->prepare("UPDATE `tbl_user` SET `first_name` = :first_name, `last_name` = :last_name, `contact_number` = :contact_number, `email` = :email, `username` = :username, `password` = :password WHERE `user_id` = :userID");
        $updateStmt->bindParam(':first_name', $updateFirstName, PDO::PARAM_STR);
        $updateStmt->bindParam(':last_name', $updateLastName, PDO::PARAM_STR);
        $updateStmt->bindParam(':contact_number', $updateContactNumber, PDO::PARAM_INT);
        $updateStmt->bindParam(':email', $updateEmail, PDO::PARAM_STR);
        $updateStmt->bindParam(':username', $updateUsername, PDO::PARAM_STR);
        $updateStmt->bindParam(':password', $updatePassword, PDO::PARAM_STR);
        $updateStmt->bindParam(':userID', $updateUserID, PDO::PARAM_INT);
        $updateStmt->execute();

        echo "
        <script>
            alert('Updated Successfully');
            window.location.href = 'http://localhost/login/admin/admin-settings.php';
        </script>
        ";

        $conn->commit();
    } else {
        echo "
        <script>
            alert('User Already Exist');
            window.location.href = 'http://localhost/login/index.php';
        </script>
        ";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}



?>

