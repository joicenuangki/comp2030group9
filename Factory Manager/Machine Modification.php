<?php

require_once "../inc/loggedin.inc.php";
FactoryManagerCheck();
require_once "../inc/dbconn.inc.php";

$machineID = $_POST['MachineID'];

if($_POST['action'] == 'Update') {
    $sql = "UPDATE Machines SET Description = ?";
}
elseif($_POST['action'] == 'Decommission') {
    $sql = "UPDATE Machines SET Decommissioned = 1 WHERE ?;";


}
elseif($_POST['action'] == 'Commission') {
    $sql = "UPDATE Machines SET Decommissioned = 0 WHERE ?;";
}
else {
    header("Location: ./Machines.php");
    exit;
}