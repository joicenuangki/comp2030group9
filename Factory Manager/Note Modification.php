<meta name="author" content="Nathan" />

<?php

require_once "../inc/loggedin.inc.php";
FactoryManagerCheck();
require "../inc/dbconn.inc.php";


if (!isset($_POST['noteID'])) {
    header("Location: ./Task Notes.php");
    exit;
}

$sql = "UPDATE Notes SET Completed = 1 WHERE NoteID = ?";

$statement = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($statement, "i", $_POST['noteID']);
if(!mysqli_stmt_execute($statement)) {
    echo(mysqli_error($conn));
    exit;
}

mysqli_stmt_close($statement);

$sql = "DELETE FROM `Assigned to Notes` WHERE NoteID = ?";

$statement = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($statement, "i", $noteID);
if(!mysqli_stmt_execute($statement)) {
    echo(mysqli_error($conn));
    exit;
}

mysqli_stmt_close($statement);
mysqli_close($conn);

header("Location: View Task Notes.php");
exit;