<meta name="author" content="Nathan" />

<?php

require_once "../inc/loggedin.inc.php";
ProductionOperatorCheck();
require "../inc/dbconn.inc.php";

if (!isset($_POST['noteID'])) {
    header("Location: ./Task Notes.php");
    exit;
}
$noteID = $_POST['noteID'];


if(isset($_POST['task']) && $_POST['task'] != '') {
    $task = $_POST['task'];
}
else {
    $task = NULL;
}

$sql = "SELECT ProductionOperatorID FROM Notes WHERE NoteID = ?;";

$statement = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($statement, "i", $noteID);
if(!mysqli_stmt_execute($statement)) {
    echo(mysqli_error($conn));
    exit;
}

$result = mysqli_stmt_get_result($statement);
$row = mysqli_fetch_assoc($result);

mysqli_stmt_close($statement);

if($row['ProductionOperatorID'] != $_SESSION['employeeID']) {
    header("Location: ./Task Notes.php");
    exit;
}

if($_POST['action'] == 'Update') {

    if (!isset($_POST['subject']) || !isset($_POST['note']) || !isset($_POST['datetime']) || !isset($_POST['task'])) {
        header("Location: ./Task Notes.php");
        exit;
    }
    $subject = $_POST['subject'];
    $note = $_POST['note'];
    $datetime = $_POST['datetime'];
    
    if($_POST['task'] != '') {
        $task = $_POST['task'];
    }
    else {
        $task = NULL;
    }

    $assignedCount = $_POST['assignedCount'];
    $unassignedCount = $_POST['unassignedCount'];

    $count = 0;
    $assignedManagers = array();
    $unassignedManagers = array();

    while($count < $assignedCount) {

        if($_POST["assignedManager$count"] != "") {
            $assignedManagers[] = $_POST["assignedManager$count"];
        }
        $count++;
    }
    $count = 0;
    while($count < $unassignedCount) {
        
        if($_POST["unassignedManager$count"] != "") {
            $unassignedManagers[] = $_POST["unassignedManager$count"];
        }
        $count++;
    }

    if($datetime != '') {
        $sql = "UPDATE Notes 
                SET Subject = ?, NoteContence = ?, JobID = ?, TimeObserved = ?
                WHERE NoteID = $noteID;";
                
        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, 'ssis', $subject, $note, $task, $datetime);
    }
    else {
        $sql = "UPDATE Notes SET Subject = ?, NoteContence = ?, JobID = ? WHERE NoteID = $noteID;";

        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, 'ssi', $subject, $note, $task);
    }
    if(!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
        exit;
    }



    foreach($assignedManagers as $managerID) {
        $sql = "DELETE FROM `Assigned to Notes` WHERE FactoryManagerID = ? AND NoteID = ?;";
        
        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, 'ii', $managerID, $noteID);

        if(!mysqli_stmt_execute($statement)) {
            echo(mysqli_error($conn));
            exit;
        }
        mysqli_stmt_close($statement);
    }

    foreach($unassignedManagers as $managerID) {
        $sql = "INSERT INTO `Assigned to Notes` (FactoryManagerID, NoteID) VALUES(?, ?);";
        
        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, 'ii', $managerID, $noteID);

        if(!mysqli_stmt_execute($statement)) {
            echo(mysqli_error($conn));
            exit;
        }
        mysqli_stmt_close($statement);
    }

    mysqli_close($conn);

    header("Location: Note Update Successful.php");
    exit;
}
elseif($_POST['action'] == 'Complete') {

    $sql = "UPDATE Notes SET Completed = 1  WHERE NoteID = ?;";

    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 'i', $noteID);

    if(!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
        exit;
    }

    mysqli_stmt_close($statement);

    $sql = "DELETE FROM `Assigned to Notes` WHERE NoteID = ?;";

    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, "i", $noteID);
    if(!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
        exit;
    }

    mysqli_stmt_close($statement);
    mysqli_close($conn);

    header("Location: Note Completion Successful.php");
    exit;
}
elseif($_POST['action'] == 'Delete') {

    $sql = "DELETE FROM Notes WHERE NoteID = ?;";

    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 'i', $noteID);

    if(!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
        exit;
    }

    mysqli_stmt_close($statement);
    mysqli_close($conn);

    header("Location: Note Deletion Successful.php");
    exit;
}
else {
    mysqli_close($conn);
    header("Location: ./Task Notes.php");
    exit;
}