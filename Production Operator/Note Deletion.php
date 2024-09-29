<?php
require_once "../inc/dbconn.inc.php";

$sql = "SELECT employeeID, FName, LName, Role FROM Employees";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

echo("$row[employeeID] $row[FName] $row[LName] $row[Role]");

mysqli_close($conn);
