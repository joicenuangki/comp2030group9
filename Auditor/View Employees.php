<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php";
    AuditorCheck();?>
    <meta charset="UTF-8">
    <meta name="author" content="Nathan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Auditor.css">
    <title>View Employees</title>
</head>
<body>
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>View Employees</h1>
        <div id="user-role"><?php DisplayInformation(); ?></div>
        <form method="post" id="search-form">
                <input type="text" placeholder="Search" id="search-bar" name="search" value="<?php echo(isset($_POST['search']) ? $_POST['search'] : ''); ?>" autocomplete="off" autofocus>
                <input type="submit" value="Search">
                <input type="hidden" name="employeeType" value="<?php echo(isset($_POST['employeeType']) ? $_POST['employeeType'] : NULL); ?>">
        </form>
    </header>
    <main id="manage-employees-main">
        <ul id="employee-management">
            <li>
                <form method="post" id="employee-management-form">
                    <ul>
                        <li><input type="submit" name="employeeType" value="All Employees"></li>
                        <li><input type="submit" name="employeeType" value="Administrator" class="administrator"></li>
                        <li><input type="submit" name="employeeType" value="Auditor" class="auditor"></li>
                        <li><input type="submit" name="employeeType" value="Factory Manager" class="factory-manager"></li>
                        <li><input type="submit" name="employeeType" value="Production Operator" class="production-operator"></li>
                        <input type="hidden" name="search" value="<?php echo(isset($_POST['search']) ? $_POST['search'] : ''); ?>">
                    </ul>
                </form>
            </li>
            <li>
                <table id="manage-employees-table">
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                    </tr>

                    <?php
                        require "../inc/dbconn.inc.php";

                        if(isset($_POST['search'])) {
                            $search = "%{$_POST['search']}%";
                        }
                        else {
                            $search = "%";
                        }

                        if(isset($_POST['employeeType']) && ($_POST['employeeType'] == 'Administrator' || $_POST['employeeType'] == 'Auditor' || $_POST['employeeType'] == 'Factory Manager' || $_POST['employeeType'] == 'Production Operator')) {

                            $sql = "SELECT EmployeeID, CONCAT(FName, ' ', LName) AS FullName, Role FROM Employees WHERE Role = ? AND (EmployeeID LIKE ? OR FName LIKE ? OR LName LIKE ?)";

                            $statement = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($statement, 'ssss', $_POST['employeeType'], $search, $search, $search);
                        }
                        else {
                            $sql = "SELECT EmployeeID, CONCAT(FName, ' ', LName) AS FullName, Role FROM Employees WHERE (EmployeeID LIKE ? OR FName LIKE ? OR LName LIKE ?)";
                            
                            $statement = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($statement, 'sss', $search, $search, $search);
                        }

                        if(!mysqli_stmt_execute($statement)) {
                            echo(mysqli_error($conn));
                            exit;
                        }
                        $result = mysqli_stmt_get_result($statement);

                        while($row = mysqli_fetch_assoc($result)) {
                            if($row['Role'] == 'Administrator') {$roleClass = 'administrator';}
                            elseif($row['Role'] == 'Auditor') {$roleClass = 'auditor';}
                            elseif($row['Role'] == 'Factory Manager') {$roleClass = 'factory-manager';}
                            elseif($row['Role'] == 'Production Operator') {$roleClass = 'production-operator';}
                            echo("
                                    <tr class='$roleClass'>
                                        <td>$row[EmployeeID]</td>
                                        <td>$row[FullName]</td>
                                    </tr>");
                        }
                        mysqli_stmt_close($statement);
                        mysqli_close($conn);
                    ?>

                </table>
            </li>
        </ul>
    </main>
    
</body>
</html>