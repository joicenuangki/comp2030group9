<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php"; 
    FactoryManagerCheck(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Factory Manager.css">
    <title>Add Machines</title>
</head>
<body>
    <?php require 'Machine Creation.php'; ?>
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>Add Machine</h1>
        <div id="user-role"><?php DisplayInformation(); ?></div>
    </header>
    <main>
        <?php 
        if(isset($_POST['name'])) {
            echo("<div id='machine-name-error-message'><b>A machine with that name already exists</b></div>");
        }
        ?>
        <form action='' method='post' id="add-machines-form">
            <ul>
                <li><label for='machine-name-field'>Machine Name</label><input type='text' id="machine-name-field" required autocomplete="off" maxlength="50" name="name"></li>
                <li><label for='machine-description-field'>Machine Description</label><textarea id='machine-description-field' autocomplete="off" maxlength="500" name="description"></textarea></li>
            </ul>

            <input type='submit' value='Add Machine'>
        </form>
        <a href="Machines.php"><button>Cancel</button></a>

    </main>
    
</body>
</html>