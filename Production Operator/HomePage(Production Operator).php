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
    <title>My Portfolio</title>
    
</head>
<body>
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>Welcome to the Home Page</h1>
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
    </main>
    <footer>
    </footer>  
    <style>

        h1{
            font-family: 'Times New Roman', Times, serif;
            font-size: 70px !important;
            text-align: center;
        }

        button {
            font-family: 'Times New Roman', Times, serif; 
            background-color: black; 
            font-size: 16px; 
            color: white; 
            width: 210px;
            height: 50px;
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
            border: black;
            display: block; 
            margin: 10px auto; 
            }

        #button:hover {
            background-color: #444; 
        } 
    
    </style>  
</body>
</html>