<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php"; 
    FactoryManagerCheck()?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Factory Manager.css">
    <title>Add Machines</title>
</head>
<body>
    <header>
        <?php include '../inc/header.inc.php';?>
        <h1>Add Machine</h1>
        <div id="user-role">Role:</div>
    </header>
    <main>
        <form action='' method='post'>
            <ul>
                <li><label for='machine-name-field'>Machine Name</label><input type='text' required></li>
                <li><label for='machine-description-field'>Machine Description</label><textarea id='machine-description-field' name='machine-description'></textarea></li>
            </ul>

            <input type='submit' value='Add Machine to Database'>
        </form>

    </main>
    
</body>
</html>