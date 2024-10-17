
<?php

require_once "../inc/loggedin.inc.php";
ProductionOperatorCheck();
require "../inc/dbconn.inc.php";


if (!isset($_POST['JobID'])) {
    header("Location: View Jobs.php");
    exit;
}


$sql = "UPDATE Jobs SET Completed = 1 WHERE JobID = ?;";

$statement = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($statement, "i", $_POST['JobID']);
if(!mysqli_stmt_execute($statement)) {
    echo(mysqli_error($conn));
    exit;
}

mysqli_stmt_close($statement);
mysqli_close($conn);

header("Location: View Jobs.php");