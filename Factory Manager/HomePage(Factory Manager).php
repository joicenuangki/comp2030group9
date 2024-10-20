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
        <h1>Welcome to the Home Page</h1>
        <div id="user-role"><?php DisplayInformation();?></div>
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
    </main>
    <footer>
    </footer>    
</body>
<style>

h1{
    font-family: 'Times New Roman', Times, serif; 
    font-size: 70px !important;
    text-align: center !important;
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

#user-role {
        margin: 0 auto; /* Center the element horizontally */
        font-size: 20px;
        font-weight: lighter;
        text-align: center; /* Center text inside the element */
        width: fit-content;
        }

</style> 
</html>