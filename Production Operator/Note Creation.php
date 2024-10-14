<?php

require_once "../inc/loggedin.inc.php";
ProductionOperatorCheck();
require "../inc/dbconn.inc.php";


$id = $_SESSION['employeeID'];

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

    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 'ssiis', $subject, $note, $task, $id, $datetime);
}
else
{
    $sql = "INSERT INTO Notes (Subject, NoteContence, JobID, ProductionOperatorID) VALUES(?, ?, ?, ?);";

    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 'ssii', $subject, $note, $task, $id);
}
if(!mysqli_stmt_execute($statement)) {
    echo(mysqli_error($conn));
    exit;
}

mysqli_stmt_close($statement);


$sql ="SELECT Max(NoteID) AS `CurrentID` FROM Notes;";

$statement = mysqli_prepare($conn, $sql);
if(!mysqli_stmt_execute($statement)) {
    echo(mysqli_error($conn));
    exit;
}
$result = mysqli_stmt_get_result($statement);
$row = mysqli_fetch_assoc($result);
$noteID = $row['CurrentID'];

mysqli_stmt_close($statement);

foreach($managers as $managerID) {
    $sql = "INSERT INTO `Assigned to Notes` (FactoryManagerID, NoteID) VALUES(?, ?);";

    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 'ii', $managerID, $noteID);

    if(!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
    }
    mysqli_stmt_close($statement);
}


mysqli_close($conn);

header("Location: Note Creation Successful.php");
