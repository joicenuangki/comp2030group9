<meta name="author" content="Nathan" />

<?php

require_once "../inc/loggedin.inc.php";
AdministratorCheck();

if(!isset($_POST['action'])){
    header("Location: Employee Modification.php");
    exit;
}
elseif($_POST['action'] == "Update Employee") {
    
    if(!isset($_POST['FName']) || !isset($_POST['LName']) || !isset($_POST['Role'])) {
        header("Location: Employee Modification.php");
        exit;
    }

    require "../inc/dbconn.inc.php";

    if($_POST['Password'] == '') {
        $sql = "UPDATE Employees SET FName = ?, LName = ?, Role = ? WHERE EmployeeID = ?;";

        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, 'sssi', $_POST['FName'], $_POST['LName'], $_POST['Role'], $_POST['EmployeeID']);
    }
    else {
        $hashedPass = password_hash($_POST['Password'], PASSWORD_DEFAULT);

        $sql = "UPDATE Employees SET FName = ?, LName = ?, Role = ?, Password = ? WHERE EmployeeID = ?;";

        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, 'ssssi', $_POST['FName'], $_POST['LName'], $_POST['Role'], $hashedPass, $_POST['EmployeeID']);
    }

    if (!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
        exit;
    }
    mysqli_stmt_close($statement);

    if($_POST['Role'] != "Production Operator") {
        mysqli_close($conn);
        header("Location: Manage Employees.php");
        exit;
    }

    $sql = "INSERT INTO Specialization(ProductionOperatorID) VALUES(?)";

    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 'i', $_POST['EmployeeID']);

    if (!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
        exit;
    }

    mysqli_stmt_close($statement);
    mysqli_close($conn);
    header("Location: Manage Employees.php");
    exit;
}
elseif($_POST['action'] == "Delete Employee") {
    require "../inc/dbconn.inc.php";

    $sql = "DELETE FROM Employees WHERE EmployeeID = ?;";
    
    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 'i', $_POST['EmployeeID']);

    if (!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
        exit;
    }

    mysqli_stmt_close($statement);
    mysqli_close($conn);

    header("Location: Manage Employees.php");
    exit;
}
elseif($_POST['action'] == "Add Employee") {
    if(!isset($_POST['FName']) || !isset($_POST['LName']) || !isset($_POST['Role']) || !isset($_POST['Password'])) {
        header("Location: Employee Modification.php");
        exit;
    }

    $hashedPass = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    
    require "../inc/dbconn.inc.php";
    
    $sql = "INSERT INTO Employees(FName, LName, Role, Password) VALUES(?, ?, ?, ?);";
    
    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 'ssss', $_POST['FName'], $_POST['LName'], $_POST['Role'], $hashedPass);
    
    if (!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
        exit;
    }
    mysqli_stmt_close($statement);
    
    if($_POST['Role'] != "Production Operator") {
        mysqli_close($conn);
        header("Location: Manage Employees.php");
        exit;
    }
    
    $sql = "SELECT Max(EmployeeID) AS CurrentID FROM Employees;";
    
    $statement = mysqli_prepare($conn, $sql);
    
    if (!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
        exit;
    }
    $result = mysqli_stmt_get_result($statement);
    $row = mysqli_fetch_assoc($result);
    $employeeID = $row['CurrentID'];
    
    mysqli_stmt_close($statement);
    
    $sql = "INSERT INTO Specialization(ProductionOperatorID) VALUES(?)";
    
    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 'i', $employeeID);
    
    if (!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
        exit;
    }
    
    mysqli_stmt_close($statement);
    mysqli_close($conn);
    header("Location: Manage Employees.php");
    exit;
}
else {
    header("Location: Manage Employees.php");
    exit;
}