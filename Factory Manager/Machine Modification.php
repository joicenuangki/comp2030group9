<?php

require_once "../inc/loggedin.inc.php";
FactoryManagerCheck();
require "../inc/dbconn.inc.php";

if(isset($_POST['action']) && isset($_POST['machineID'])) {
    if($_POST['action'] == 'Update') {
        $sql = "UPDATE Machines SET Description = ? WHERE MachineID = ?";

        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, 'si', $_POST['description'], $_POST['machineID']);
    }
    else {
        if($_POST['action'] == 'Decommission') {
            $sql = "UPDATE Machines SET Decommissioned = 1 WHERE MachineID = ?;";

        }
        elseif($_POST['action'] == 'Commission') {
            $sql = "UPDATE Machines SET Decommissioned = 0 WHERE MachineID = ?;";
        }
        elseif($_POST['action'] == 'Delete') {
            $sql = "DELETE FROM Machines WHERE MachineID = ?;";
        }
        else {
            mysqli_close($conn);
            header("Location: Machines.php");
            exit;
        }
        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, 'i', $_POST['machineID']);
    }
}
else {
    mysqli_close($conn);
    header("Location: Machines.php");
    exit;
}

if(!mysqli_stmt_execute($statement)) {
    echo(mysqli_error($conn));
    exit;
}

mysqli_stmt_close($statement);
mysqli_close($conn);

header("Location: Machines.php");
exit;