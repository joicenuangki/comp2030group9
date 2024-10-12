<?php

require_once "../inc/loggedin.inc.php";
require_once "../inc/dbconn.inc.php";

$id = $_SESSION['employeeID'];

$roleName = $_POST['role_name'];
$permissions = $_POST['permissions'];
$totalCount = $_POST['count'];

$count = 0;
$assignedUsers = array();

while($count < $totalCount) {
    if($_POST["user$count"] != "") {
        $assignedUsers[] = $_POST["user$count"];
    }
    $count++;
}

if ($roleName != '') {
    $sql = "INSERT INTO Roles (RoleName) VALUES(?);";
    $statement = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($statement, $sql);
    mysqli_stmt_bind_param($statement, 's', $roleName);

    if (!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
        exit;
    }

    $sql = "SELECT Max(RoleID) AS `CurrentID` FROM Roles;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $RoleID = $row['CurrentID'];

    foreach ($permissions as $permission) {
        $sql = "INSERT INTO RolePermissions (RoleID, Permission) VALUES(?, ?);";
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql);
        mysqli_stmt_bind_param($statement, 'is', $RoleID, $permission);
        if (!mysqli_stmt_execute($statement)) {
            echo(mysqli_error($conn));
        }
    }
    foreach ($assignedUsers as $userID) {
        $sql = "INSERT INTO UserRoles (UserID, RoleID) VALUES(?, ?);";
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql);
        mysqli_stmt_bind_param($statement, 'ii', $userID, $RoleID);
        if (!mysqli_stmt_execute($statement)) {
            echo(mysqli_error($conn));
        }
    }
}

mysqli_close($conn);

header("Location: Add And Manage User Roles.php");
?>
