<meta name="author" content="Nathan" />

<?php

session_start();


if(!isset($_SESSION['employeeID']) || !isset($_SESSION['role'])) {
    header("Location: ../main/LoginPage.php");
    exit;
}

if (isset($_SESSION['timeOfPageChange']) && (time() - $_SESSION['timeOfPageChange']) > 600) {
    header("Location: ../main/Logout.php");
    exit;
}
$_SESSION['timeOfPageChange'] = time();


?>
<script type="text/javascript">
    let autoLogoutTime;
    function resetTimeout() {
        clearTimeout(autoLogoutTime);
        autoLogoutTime = setTimeout(logout, 300000);
    }
    function logout() {
        window.location.href = '../main/Logout.php';
    }

    document.onkeypress = resetTimeout;
    document.onmousemove = resetTimeout;
    document.onscroll = resetTimeout;
    document.onload = resetTimeout;
</script>



<?php
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


    if($_SESSION['role'] != 'Production Operator') {
        echo("Role: " . $_SESSION['role'] . "<br>Employee ID: " . $_SESSION['employeeID']);
    }
    else {
        require '../inc/dbconn.inc.php';

        $sql = "SELECT Specialization FROM Specialization WHERE ProductionOperatorID = ?";

        $statement = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($statement, "i", $_SESSION['employeeID']);
        if(!mysqli_stmt_execute($statement)) {
            echo(mysqli_error($conn));
            exit;
        }

        $result = mysqli_stmt_get_result($statement);
        $row = mysqli_fetch_assoc($result);

        echo("Role: " . $_SESSION['role'] . "<br>Specialization: " . $row['Specialization'] . "<br>Employee ID: " . $_SESSION['employeeID']);


        mysqli_stmt_close($statement);
        mysqli_close($conn);
    }
}