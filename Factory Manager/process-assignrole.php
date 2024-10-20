
<?php

require_once "../inc/loggedin.inc.php"; 
FactoryManagerCheck(); 
require "../inc/dbconn.inc.php";
    
$newSpec = $_POST["Specialization"];
$employee = $_POST["EmployeeID"];


$updateQuery = "UPDATE specialization SET Specialization=? WHERE ProductionOperatorID = ?;";
$stmt = $conn->prepare($updateQuery);
$stmt->bind_param("si", $newSpec, $employee);
$stmt->execute();

mysqli_close($conn);

header("Location: Role-Updated.php");