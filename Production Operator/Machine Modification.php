<?php

require_once "../inc/loggedin.inc.php";
ProductionOperatorCheck();
require "../inc/dbconn.inc.php";

if(isset($_POST['action']) && isset($_POST['machineID'])) {
    if($_POST['action'] == 'Update') {
        $sql = "UPDATE Machines SET Description = ? WHERE MachineID = ?";

        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, 'si', $_POST['description'], $_POST['machineID']);

        if(!mysqli_stmt_execute($statement)) {
            echo(mysqli_error($conn));
            exit;
        }
    }
}

mysqli_stmt_close($statement);
mysqli_close($conn);

header("Location: Machines.php");
exit;