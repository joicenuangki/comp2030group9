<meta name="author" content="Nathan" >

<?php

session_start();

if(isset($_SESSION['employeeID']) && isset($_SESSION['role'])) {
    header("Location: ../main");
    exit;
}


if(isset($_POST['employeeID']) && isset($_POST['password'])) {

    require "../inc/dbconn.inc.php";

    $sql = "SELECT EmployeeID, Role, Password FROM Employees WHERE EmployeeID = ?;";

    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 'i', $_POST['employeeID']);

    if (!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
        exit;
    }
    $result = mysqli_stmt_get_result($statement);
    mysqli_stmt_close($statement);
    mysqli_close($conn);

    if($row = mysqli_fetch_assoc($result)) {
        if(password_verify($_POST['password'], $row['Password'])) {

            $_SESSION['employeeID'] = $row['EmployeeID'];
            $_SESSION['role'] = $row['Role'];

            header("Location: ../main");
            exit;
        }
    }   

    

}