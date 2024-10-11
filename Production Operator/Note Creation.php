<?php

require_once "../inc/loggedin.inc.php";
ProductionOperatorCheck();
require_once "../inc/dbconn.inc.php";


$id = $_SESSION['employeeID'];

$subject = $_POST['subject'];
$note = $_POST['note'];
$datetime = $_POST['datetime'];
if($_POST['task'] != '') {
    $task = $_POST['task'];
}
else {
    $task = NULL;
}

$totalCount = $_POST['count'];

$count = 0;
$managers = array();

while($count < $totalCount) {
    if($_POST["manager$count"] != "") {
        $managers[] = $_POST["manager$count"];

    }
    $count++;
}

if($datetime != '') 
{
    $sql = "INSERT INTO Notes (Subject, NoteContence, JobID, ProductionOperatorID, TimeObserved) VALUES(?, ?, ?, ?, ?);";
    $statement = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_bind_param($statement, 'ssiis', $subject, $note, $task, $id, $datetime);
}
else
{
    $sql = "INSERT INTO Notes (Subject, NoteContence, JobID, ProductionOperatorID) VALUES(?, ?, ?, ?);";
    $statement = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_bind_param($statement, 'ssii', $subject, $note, $task, $id);
}
if(!mysqli_stmt_execute($statement)) {
    echo(mysqli_error($conn));
    exit;
}


$sql ="SELECT Max(NoteID) AS `CurrentID` FROM Notes;";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$NoteID = $row['CurrentID'];

foreach($managers as $managerID) {
    $sql = "INSERT INTO `Assigned to Notes` (FactoryManagerID, NoteID) VALUES(?, ?);";
    $statement = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_bind_param($statement, 'ii', $managerID, $NoteID);

    if(!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
    }
}


mysqli_close($conn);

header("Location: Task Notes.php");
