<?php

session_start();

if(!isset($_SESSION['employeeID']) || !isset($_SESSION['role'])) {
    header("Location: ../main/LoginPage.php");
    exit;
}

function ProductionOperatorCheck() {
    if($_SESSION['role'] != 'Production Operator'){
        header("Location: ../main/Homepage.php");
        exit;
    }
}

function FactoryManagerCheck() {
    if($_SESSION['role'] != 'Factory Manager'){
        header("Location: ../main/Homepage.php");
        exit;
    }
}

function AuditorCheck() {
    if($_SESSION['role'] != 'Auditor'){
        header("Location: ../main/Homepage.php");
        exit;
    }
}

function AdministratorCheck() {
    if($_SESSION['role'] != 'Administrator'){
        header("Location: ../main/Homepage.php");
        exit;
    }
}