<?php

require_once "../inc/loggedin.inc.php";
require_once "../inc/dbconn.inc.php";
$id = $_SESSION['employeeID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] === 'add') {
    $roleName = $_POST['role_name'];

    if ($roleName != '') {
        $sql = "INSERT INTO Roles (RoleName) VALUES(?);";
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql);
        mysqli_stmt_bind_param($statement, 's', $roleName);
        mysqli_stmt_execute($statement);
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] === 'update') {
    $existingRole = $_POST['existing_role'];
    $newRoleName = $_POST['new_role_name'];

    if ($newRoleName != '') {
        $sql = "UPDATE Roles SET RoleName = ? WHERE RoleName = ?;";
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql);
        mysqli_stmt_bind_param($statement, 'ss', $newRoleName, $existingRole);
        mysqli_stmt_execute($statement);
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] === 'delete') {
    $deleteRole = $_POST['delete_role'];

    if ($deleteRole != '') {
        $sql = "DELETE FROM Roles WHERE RoleName = ?;";
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql);
        mysqli_stmt_bind_param($statement, 's', $deleteRole);
        mysqli_stmt_execute($statement);
    }
}
mysqli_close($conn);
header("Location: Add and Manage User Roles.php");
exit;
?>
