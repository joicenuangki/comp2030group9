<?php

session_start();

if(!isset($_SESSION['employeeID']) || !isset($_SESSION['role'])) {
    header("Location: ../main/LoginPage.php");
    exit;
}

function ProductionOperatorCheck() {
    if($_SESSION['role'] != 'Production Operator'){
        header("Location: ../main");
        exit;
    }
}

function FactoryManagerCheck() {
    if($_SESSION['role'] != 'Factory Manager'){
        header("Location: ../main");
        exit;
    }
}

function AuditorCheck() {
    if($_SESSION['role'] != 'Auditor'){
        header("Location: ../main");
        exit;
    }
}

function AdministratorCheck() {
    if($_SESSION['role'] != 'Administrator'){
        header("Location: ../main");
        exit;
    }
}

function DisplayInformation() {
    echo("Role: " . $_SESSION['role'] . "<br>Employee ID: " . $_SESSION['employeeID']);
}