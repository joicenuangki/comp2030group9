<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php";
    ProductionOperatorCheck();?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Joice" /><!-- TODO: enter your name as the content attribute value -->
    <meta name="description" content="Practical 1" />
    <link rel="stylesheet" href="../Styles/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@900&display=swap" rel="stylesheet">
    <title>My Portfolio</title>
    
</head>
<body>
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>Home Page</h1>
        <div id="user-role"><?php DisplayInformation();?></div>
        <p></p>
    </header>
    <main>
    <a href="../main/Dashboard.php"><button id="Monitor-Factory-Performance">View Factory Performance</button></a>
    <p></P>
    <a href="Machines.php"><button id="Update-Machines">Update Machines</button></a>
    <p></P>
    <a href="View Jobs.php"><button id="Update-Jobs">Update Jobs</button></a>
    <p></P>
    <a href="Task Notes.php"><button id="add-employee">Manage Task Notes</button></a>
    <p></P>
        <img 
        src="../Images/CM - Manufacturer option 1.jpg"
        alt="Ribbon"
        class="Manufactoring"
        >
    </main>
    <footer>
    </footer>  
    <style>

        h1{
            font-family: 'Source Sans Pro';
        }
    </style>  
</body>
</html>