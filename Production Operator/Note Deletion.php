<?php
require_once "../inc/loggedin.inc.php";
require_once "../inc/dbconn.inc.php";

$NoteID = $_GET['noteID'];

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
