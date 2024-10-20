<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php";
    AdministratorCheck();?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Benjamin" />
    <meta name="description" content="Practical 1" />
    <link rel="stylesheet" href="../Styles/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@900&display=swap" rel="stylesheet">
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
    <a href="Manage Employees.php"><button id="add-employee">Manage User Accounts</button></a>
    <p></p>
    <a href="../main/Dashboard.php"><button id="add-employee">View Factory Performance</button></a>
    <p></P>
    <a href="Machines.php"><button id="add-employee">View Machines</button></a>
    </main>
    <footer>
    </footer> 
    
    <style>

h1{
    font-family: 'Source Sans Pro';
    font-size: 70px !important;
    text-align: center;
}

button {
    font-family: 'Source Sans Pro' !important; 
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