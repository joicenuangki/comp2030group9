<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php";
    AuditorCheck();?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Joice" /><!-- TODO: enter your name as the content attribute value -->
    <meta name="description" content="Practical 1" />
    <link rel="stylesheet" href="../Styles/Style.css">
    <title>My Portfolio</title>
</head>
<body>
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>Welcome to the Smart Manufactoring Dashboard</h1>
        <h3>Role: Auditor</h3>
        <p></p>
    </header>
    <main>
        <a href="Summary Report.php"><button id="add-employee">Create Summary Report</button></a>
        <p></P>
        <a href="../main/Dashboard.php"><button id="add-employee">View Dashboard</button></a>
        <p></P>
        <a href="../main/Logout.php"><button id="add-employee">Log Out</button></a>
        <p></P>

        <img 
        src="../Images/CM - Manufacturer option 1.jpg"
        alt="Ribbon"
        class="Manufactoring"
        >
    </main>
    <footer>
    </footer>    
</body>
</html>