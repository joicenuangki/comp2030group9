
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Overview</title> 
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Factory Manager.css">
    <link rel="stylesheet" href="../Factory Manager/factorymanager2.css">
    

    <?php 
        require_once "../inc/loggedin.inc.php"; 
        require "../inc/dbconn.inc.php";
        ProductionOperatorCheck();
     ?>
</head>
<body>
    <header>
    <?php include_once '../inc/header.inc.php';?>
        <h1>Jobs Overview</h1>
        <div id="user-role"><?php DisplayInformation(); ?></div>
     </header>

    <main id="JobsOverview"> 
        
        <h2>Current Jobs:</h2>

        <table class="table">
            <thead class="">
                <th>Name</th>
                <th>Description</th>
                <th>Machine</th>
                <th>Priority</th>
                <th>Date</th>
                <th>Manager Assigned</th>
                <th>Mark Completed</th>
            </thead>
            <tbody>
                <?php
                    
                    $sql = "SELECT Jobs.JobID, Jobs.Name, Jobs.Desc, Jobs.Priority, Jobs.AssignedDate, Jobs.FactoryManagerID, Jobs.MachineID
                            FROM Jobs
                            JOIN `Assigned to Jobs` ON Jobs.JobID = `Assigned to Jobs`.JobID
                            WHERE `Assigned to Jobs`.ProductionOperatorID = ? AND Jobs.Completed = 0;";

                    $statement = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($statement, 'i', $_SESSION['employeeID']);

                    if(!mysqli_stmt_execute($statement)) {
                        echo(mysqli_error($conn));
                        exit;
                    }

                    $result = mysqli_stmt_get_result($statement);

                    while($row = mysqli_fetch_assoc($result)) {
                        echo"<tr> 
                        <td>". $row["Name"] . "</td>
                        <td>". $row["Desc"] . "</td>
                        <td>". $row["MachineID"] . "</td>
                        <td>". $row["Priority"] . "</td>
                        <td>". $row["AssignedDate"] . "</td>
                        <td>". $row["FactoryManagerID"] . "</td>
                        <td>
                            <form method='POST' action='Job Completion.php'>
                            <input type='hidden' name='JobID' id='JobID' value='" . $row['JobID'] . "'>
                            <input type='submit' name='action' value='Mark Completed'>
                            </form>
                                
                            
                        </td>
                
                        </tr>";
                    }

                    mysqli_stmt_close($statement);
                    mysqli_close($conn);
                    
                ?>
            </tbody>

        </table>
    
    </main>

</body>
</html>
