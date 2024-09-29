<?php

require_once "../inc/dbconn.inc.php";

$sql = "INSERT INTO NOTES(JobID, Subject, TimeObserved, NoteContence, ProductionOperatorID) VALUES(?);";