<?php
require_once "../inc/dbconn.inc.php";

$sql = "SELECT employeeID, FName, LName FROM Employees";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

echo("$row[employeeID] $row[FName] $row[LName]");

mysqli_close($conn);
