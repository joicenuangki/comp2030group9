<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php";
    FactoryManagerCheck();?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Joice" />
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Factory Manager.css">
    <title>SMD Homepage</title>
</head>
<body id="home-factory-manager">
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>Welcome to the Home Page</h1>
        <div id="user-role"><?php DisplayInformation();?></div>
        <p></p>
    </header>
    <main>
        <a href="../main/Dashboard.php"><button>View Factory Performance</button></a>
        <p></p>
        <a href="Machines.php"><button>Update Machines</button></a>
        <p></p>
        <a href="JobsOverview.php"><button>Update Jobs</button></a>
        <p></p>
        <a href="View Task Notes.php"><button>View Task Notes</button></a>
    </main>
</body>
</html>