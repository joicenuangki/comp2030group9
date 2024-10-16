<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once "../inc/loggedin.inc.php"; 
        AdministratorCheck();
        require "../inc/dbconn.inc.php";

        if(!isset($_POST['EmployeeID'])) {
            header("Location: Manage Employees.php");
            exit;
        }
        $sql = "SELECT FName, LName, Role FROM Employees WHERE EmployeeID = ?";
        
        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, 'i', $_POST['EmployeeID']);

        if (!mysqli_stmt_execute($statement)) {
            echo(mysqli_error($conn));
            exit;
        }
        $result = mysqli_stmt_get_result($statement);
        $row = mysqli_fetch_assoc($result);

        mysqli_stmt_close($statement);
        mysqli_close($conn);
    ?>
    <meta charset="UTF-8">
    <meta name="author" content="Nathan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Administrator.css">
    <title>Update Employee</title>
</head>
<body>
    <header>
        <?php include_once "../inc/header.inc.php"; ?>
        <h1>Update Employee</h1>
        <div id="user-role"><?php DisplayInformation(); ?></div>
    </header>
    <main>
        <h2>Editing Employee ID: <?php echo($_POST['EmployeeID']); ?></h2>
        <form method="post" action="Employee Modification.php" id="update-employees-form">
            <ul>
                <li><label for="first-name">First Name </label><input type="text" id="first-name" name="FName" autocomplete="off" required maxlength="25" value="<?php echo($row['FName']); ?>"></li>
                <li><label for="last-name">Last Name </label><input type="text" id="last-name" name="LName" autocomplete="off" required maxlength="25" value="<?php echo($row['LName']); ?>"></li>
                <li>
                    <label for="role">Role </label>
                    <select id="role" name="Role">
                        <option value="Administrator" <?php if($row['Role'] == "Administrator") {echo("selected");} ?>>Administrator</option>
                        <option value="Auditor" <?php if($row['Role'] == "Auditor") {echo("selected");} ?>>Auditor</option>
                        <option value="Factory Manager" <?php if($row['Role'] == "Factory Manager") {echo("selected");} ?>>Factory Manager</option>
                        <option value="Production Operator" <?php if($row['Role'] == "Production Operator") {echo("selected");} ?>>Production Operator</option>
                    </select>
                </li>
                <li>
                    <b>Warning</b> for security passwords cannot be easily recovered <b>Note password down</b><br>
                    <label for="password">New Password </label>
                    <input type="password" id="password" name="Password" autocomplete="off" maxlength="30"><br>
                    Leave blank to not change password
                </li>
            </ul>
            <input type="hidden" name="EmployeeID" value="<?php echo($_POST['EmployeeID']); ?>">
            <input type="submit" name="action" value="Update Employee"><br>
            <input type="submit" name="action" value="Delete Employee">
        </form>
        <a href="Manage Employees.php"><button>Cancel</button></a>
    </main>
</body>
</html>
