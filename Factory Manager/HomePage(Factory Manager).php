<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php";
    FactoryManagerCheck();?>
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
        <h3>Role: Factory Manager</h3>
        <p></p>
    </header>
    <main>
    <a href="../main/Dashboard.php"><button id="add-employee">View Factory Performance</button></a>
    <p></p>
    <a href="Machines.php"><button id="add-employee">Update Machines</button></a>
    <p></p>
    <a href="JobsOverview.php"><button id="add-employee">Update Jobs</button></a>
    <p></p>
    <a href="View Task Notes.php"><button id="add-employee">View Task Notes</button></a>
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