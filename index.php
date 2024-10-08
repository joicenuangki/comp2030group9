<?php

session_start();

if(!isset($_SESSION['employeeID']) || !isset($_SESSION['role'])) {
    header("Location: main/LoginPage.php");
}
else {
    header("Location: main/Homepage.php");
}
