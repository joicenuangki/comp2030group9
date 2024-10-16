<meta name="author" content="Nathan" />

<?php

require_once "../inc/loggedin.inc.php";
AdministratorCheck();


if(!isset($_POST['FName']) || !isset($_POST['LName']) || !isset($_POST['Role']) || !isset($_POST['Password'])) {
    header("Location: Employee Modification.php");
    exit;
}

require "../inc/dbconn.inc.php";

$sql = "INSERT INTO Employees(FName, LName, Role, Password) VALUES(?, ?, ?, ?);";

$statement = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($statement, 'ssss', $_POST['FName'], $_POST['LName'], $_POST['Role'], $_POST['Password']);

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