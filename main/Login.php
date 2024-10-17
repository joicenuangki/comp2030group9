<meta name="author" content="Nathan" />

<?php

session_start();



if(isset($_POST['employeeID']) && isset($_POST['password'])) {
    require "../inc/dbconn.inc.php";

    $sql = "SELECT EmployeeID, Role FROM Employees WHERE EmployeeID = ? AND Password = ?;";

    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 'is', $_POST['employeeID'], $_POST['password']);

    if (!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
        exit;
    }
    $result = mysqli_stmt_get_result($statement);
    mysqli_stmt_close($statement);
    mysqli_close($conn);

    if($row = mysqli_fetch_assoc($result)) {
        $_SESSION['employeeID'] = $row['EmployeeID'];
        $_SESSION['role'] = $row['Role'];

        header("Location: ../main");
        exit;
    }   
}