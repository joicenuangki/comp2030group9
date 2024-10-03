<?php
require_once "../inc/dbconn.inc.php";

$sql = "SELECT employeeID, FName, LName, Role FROM Employees ORDER BY employeeID DESC";


if($result = mysqli_query($conn, $sql)) {
    if(1 <= mysqli_num_rows($result)) {
        while($row = mysqli_fetch_assoc($result)) {
            echo("$row[employeeID] $row[FName] $row[LName] $row[Role]<br>");
        }
    }
}





mysqli_close($conn);
