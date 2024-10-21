<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php";
    AuditorCheck();?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Joice" />
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Auditor.css">
    <title>SMD Homepage</title>
</head>
<body id="home-auditor">
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>Welcome to the Home Page</h1>
        <div id="user-role"><?php DisplayInformation();?></div>
        <p></p>
    </header>
    <main>
        <a href="Summary Report.php"><button>Create Summary Report</button></a>
        <p></P>
        <a href="../main/Dashboard.php"><button>View Factory Performance</button></a>
        <p></P>
        <a href="Machines.php"><button>View Machines</button></a>
        <p></p>
        <a href="View Employees.php"><button>View Employees</button></a>
    </main>
</body>
</html>