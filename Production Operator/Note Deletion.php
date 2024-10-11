<?php
require_once "../inc/loggedin.inc.php";
ProductionOperatorCheck();
require_once "../inc/dbconn.inc.php";

$NoteID = $_GET['noteID'];

$sql = "SELECT ProductionOperatorID FROM Notes WHERE NoteID = ?";

$statement = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($statement, "i", $NoteID);
mysqli_stmt_execute($statement);

$result = mysqli_stmt_get_result($statement);
$row = mysqli_fetch_assoc($result);

mysqli_stmt_close($statement);

if($row['ProductionOperatorID'] != $_SESSION['employeeID']) {
    header("Location: ../Production Operator/Task Notes.php");
    exit;
}


$sql = "UPDATE Notes SET Completed = 1  WHERE NoteID = ?;";

$statement = mysqli_stmt_init($conn);

mysqli_stmt_prepare($statement, $sql); 
mysqli_stmt_bind_param($statement, 'i', $NoteID);

if(mysqli_stmt_execute($statement)) {
    header("Location: ../Production Operator/Note Deletion Successful.php");
}
else {
    echo(mysqli_error($conn));
    exit;
}
mysqli_stmt_close($statement);

$sql = "DELETE FROM `Assigned to Notes` WHERE NoteID = ?";

$statement = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($statement, "i", $NoteID);
mysqli_stmt_execute($statement);

mysqli_stmt_close($statement);
mysqli_close($conn);
