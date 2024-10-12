<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php"; 
    FactoryManagerCheck();?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Factory Manager.css">
    <title>Machines</title>
</head>
<body>
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>Machines Overview</h1>
        <div id="user-role"><?php DisplayInformation();?></div>
    </header>
    <main>
        <a href="View Machines.php"><button>View Update and Delete<br>Machines and Descriptions</button></a>
        <a href="Add Machines.php"><button>Add Machines</button></a>
        <a href="Diagnose Machines.php"><button>Diagnose Machines</button></a>
    </main>
    
</body>
</html>