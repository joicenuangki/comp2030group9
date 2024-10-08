<?php
require_once "../inc/loggedin.inc.php";
require_once "../inc/dbconn.inc.php";

$NoteID = $_GET['noteID'];

$sql = "SELECT ProductionOperatorID FROM Notes WHERE NoteID = $NoteID";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

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
}

mysqli_close($conn);
