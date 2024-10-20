<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php"; 
    AdministratorCheck();?>
    <meta charset="UTF-8">
    <meta name="author" content="Nathan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Administrator.css">
    <title>Add Employee</title>
</head>
<body>
    <header>
        <?php include_once "../inc/header.inc.php"; ?>
        <h1>Add Employee</h1>
        <div id="user-role"><?php DisplayInformation(); ?></div>
    </header>
    <main id="add-employees-main">
        <form method="post" action="Employee Modification.php" id="add-employees-form">
            <ul>
                <li><label for="first-name">First Name </label><input type="text" id="first-name" name="FName" autocomplete="off" required maxlength="25"></li>
                <li><label for="last-name">Last Name </label><input type="text" id="last-name" name="LName" autocomplete="off" required maxlength="25"></li>
                <li>
                    <label for="role">Role </label>
                    <select id="role" name="Role">
                        <option value="Administrator">Administrator</option>
                        <option value="Auditor">Auditor</option>
                        <option value="Factory Manager">Factory Manager</option>
                        <option value="Production Operator">Production Operator</option>
                    </select>
                </li>
                <li><label for="password">Password </label><input type="password" id="password" name="Password" autocomplete="off" required maxlength="60"></li>
            </ul>
            <input type="submit" name="action" value="Add Employee" id="submit-button">
        </form>
        <a href="Manage Employees.php"><button id="cancel-button">Cancel</button></a>
    </main>
</body>
</html>
