<meta name="author" content="Nathan" />

<?php

require_once "../inc/loggedin.inc.php";

if($_SESSION['role'] == 'Production Operator') {
    header("Location: ../Production Operator/HomePage(Production Operator).php");
    exit;
}
elseif($_SESSION['role'] == 'Factory Manager') {
    header("Location: ../Factory Manager/HomePage(Factory Manager).php");
    exit;
}
elseif($_SESSION['role'] == 'Auditor') {
    header("Location: ../Auditor/HomePage(Auditor).php");
    exit;
}
elseif($_SESSION['role'] == 'Administrator') {
    header("Location: ../Admin/HomePage(Admin).php");
    exit;
}