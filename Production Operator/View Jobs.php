
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once "../inc/loggedin.inc.php"; 
        ProductionOperatorCheck();
        require "../inc/dbconn.inc.php";
     ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Overview</title> 
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Production Operator.css">
</head>
<body>
    <header>
    <?php include_once '../inc/header.inc.php';?>
        <h1>Jobs Overview</h1>
        <div id="user-role"><?php DisplayInformation(); ?></div>
     </header>

    <main id="jobs-main"> 
        <form method="post">
                <input type="text" placeholder="Search" id="search-bar" name="search" value="<?php echo(isset($_POST['search']) ? $_POST['search'] : ''); ?>" autocomplete="off" autofocus>
                <input type="submit" value="Search">
        </form>
        
        <h2>Current Jobs:</h2>

        <table class="table">
            <th>Name</th>
            <th>Description</th>
            <th>Machine</th>
            <th>Priority</th>
            <th>Date</th>
            <th>Manager Assigned</th>
            <th>Mark Completed</th>
            <?php

                if(isset($_POST['search'])) {
                    $search = "%{$_POST['search']}%";
                }
                else {
                    $search = "%";
                }
                
                $sql = "SELECT Jobs.JobID, Jobs.Name, Jobs.Desc, Jobs.Priority, Jobs.AssignedDate, CONCAT(FName, ' ', LName) AS FullName, MachineName
                        FROM Jobs
                        JOIN `Assigned to Jobs` ON Jobs.JobID = `Assigned to Jobs`.JobID
                        JOIN Employees ON Employees.EmployeeID = Jobs.FactoryManagerID
                        LEFT JOIN Machines ON Jobs.MachineID = Machines.MachineID
                        WHERE `Assigned to Jobs`.ProductionOperatorID = ? AND Jobs.Completed = 0 
                        AND (Jobs.JobID LIKE ? OR Name LIKE ? OR Jobs.Desc LIKE ? OR Priority LIKE ? OR AssignedDate LIKE ? OR FName LIKE ? OR LName LIKE ? OR MachineName LIKE ?);";

                $statement = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($statement, 'issssssss', $_SESSION['employeeID'], $search, $search, $search, $search, $search, $search, $search, $search);

                if(!mysqli_stmt_execute($statement)) {
                    echo(mysqli_error($conn));
                    exit;
                }

                $result = mysqli_stmt_get_result($statement);

                while($row = mysqli_fetch_assoc($result)) {
                    echo"<tr> 
                    <td>". $row["Name"] . "</td>
                    <td>". $row["Desc"] . "</td>
                    <td>". $row["MachineName"] . "</td>
                    <td>". $row["Priority"] . "</td>
                    <td>". $row["AssignedDate"] . "</td>
                    <td>". $row["FullName"] . "</td>
                    <td>
                        <form method='POST' action='Job Completion.php'>
                            <input type='hidden' name='JobID' id='JobID' value='" . $row['JobID'] . "'>
                            <input type='submit' name='action' value='Complete'>
                        </form>
                    </td>
            
                    </tr>";
                }

                mysqli_stmt_close($statement);
                mysqli_close($conn);
                
            ?>
        </table>
    
    </main>

</body>
</html>
