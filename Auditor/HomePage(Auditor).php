<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@900&display=swap" rel="stylesheet">
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
        <h1>Welcome to the Home Page</h1>
        <div id="user-role"><?php DisplayInformation();?></div>
        <p></p>
    </header>
    <main>
        <a href="Summary Report.php"><button id="add-employee">Create Summary Report</button></a>
        <p></P>
        <a href="../main/Dashboard.php"><button id="add-employee">View Factory Performance</button></a>
        <p></P>
        <a href="Machines.php"><button id="add-employee">View Machines</button></a>
        <p></p>
    </main>
    <footer>
    </footer>    
</body>
<style>

h1{
    font-family: 'Source Sans Pro';
    font-size: 70px !important;
    text-align: center;
}

button {
    font-family: 'Source Sans Pro' !important; /* Font for the button */
    background-color: black; /* Button background color */
    font-size: 16px; /* Font size */
    color: white; /* Text color */
    width: 210px;
    height: 50px;
    border-radius: 10px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease;
    border: black;
    display: block; /* Make buttons block elements */
    margin: 10px auto; /* Center buttons with automatic left/right margins */
    }

#button:hover {
    background-color: #444; /* Change this to your desired hover color */  
} 

</style>  
</html>