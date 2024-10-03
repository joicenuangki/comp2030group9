<?php

require_once "../inc/dbconn.inc.php";

$id = 1;

$subject = $_POST['subject'];
$note = $_POST['note'];
$task = $_POST['task'];
if(isset($_POST['assign'])) {$assign = $_POST['assign'];}
$datetime = $_POST['datetime'];


if($datetime != '' && $task != '') 
{
    $sql = "INSERT INTO Notes (Subject, NoteContence, JobID, ProductionOperatorID, TimeObserved) VALUES(?, ?, ?, ?, ?);";
    $statement = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_bind_param($statement, 'sssis', $subject, $note, $task, $id, $datetime);

    if(mysqli_stmt_execute($statement)) {

    }
    else {
        echo(mysqli_error($conn));
    }
}
elseif($datetime == '' && $task != '' )
{
    $sql = "INSERT INTO Notes (Subject, NoteContence, JobID, ProductionOperatorID) VALUES(?, ?, ?, ?);";
    $statement = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_bind_param($statement, 'sssi', $subject, $note, $task, $id);

    if(mysqli_stmt_execute($statement)) {

    }
    else {
        echo(mysqli_error($conn));
    }
}
elseif($datetime != '' && $task == '')
{
    $sql = "INSERT INTO Notes (Subject, NoteContence, ProductionOperatorID, TimeObserved) VALUES(?, ?, ?, ?);";
    $statement = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_bind_param($statement, 'ssis', $subject, $note, $id, $datetime);

    if(mysqli_stmt_execute($statement)) {

    }
    else {
        echo(mysqli_error($conn));
    }
}
else {
    $sql = "INSERT INTO Notes (Subject, NoteContence, ProductionOperatorID) VALUES(?, ?, ?);";
    $statement = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_bind_param($statement, 'ssi', $subject, $note, $id);

    if(mysqli_stmt_execute($statement)) {

    }
    else {
        echo(mysqli_error($conn));
    }
}

$sql ="SELECT Max(NoteID) AS `CurrentID` FROM Notes;";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$NoteID = $row['CurrentID'];


$sql = "INSERT INTO `Assigned to Notes` (FactoryManagerID, NoteID) VALUES(?, ?);";
$statement = mysqli_stmt_init($conn);

mysqli_stmt_prepare($statement, $sql); 
mysqli_stmt_bind_param($statement, 'ii', $assign, $NoteID);

if(mysqli_stmt_execute($statement)) {
    header("location: Task Notes.php");
}
else {
    echo(mysqli_error($conn));
}



mysqli_close($conn);
