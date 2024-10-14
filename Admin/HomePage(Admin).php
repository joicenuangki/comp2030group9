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
    <title>My Portfolio</title>
</head>
<body>
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>Welcome to the Smart Manufactoring Dashboard</h1>
        <h3>Role: Administrator</h3>
        <p></p>
    </header>
    <main>
        <button>Add Another New Job</button>
        <p></p>
        <button>Manage User Roles</button>
        <P></P>
        <button>Manage User Roles</button>
        <p></p>
        <button>See Diagrams</button>
        <p></p>
        <P></P>
        <button>Report a Problem</button>
        <P></P>
        <button>Logout</button>

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