<?php

session_start();

require_once "../inc/dbconn.inc.php";

if(isset($_POST['employeeID']) && isset($_POST['password'])) {
    $empID = $_POST['employeeID'];
    $pass = $_POST['password'];

    $sql = "SELECT EmployeeID, Role FROM Employees WHERE EmployeeID = '$empID' AND Password = '$pass'";

    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result)) {
        $_SESSION['employeeID'] = $row['EmployeeID'];
        $_SESSION['role'] = $row['Role'];

        header("Location: ../main/HomePage.php");
    }
    else {
        header("Location: ../main/LoginPage.php");
    }
        
}
else {
    header("Location: ../main/LoginPage.php");
}