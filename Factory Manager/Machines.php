<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php"; 
    FactoryManagerCheck(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Factory Manager.css">
    <title>Machines Overview</title>
</head>
<body>
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>Machines Overview</h1>
        <div id="user-role"><?php DisplayInformation();?></div>
    </header>
    <main>
        <ul id="machines-ul">
            <li><form method="post">
                <input type="text" placeholder="Search" id="search-bar" name="search" value="<?php echo(isset($_POST['search']) ? $_POST['search'] : ''); ?>" autocomplete="off" autofocus>
                <input type="submit" value="Search">
            </form></li>
            <li><a href="Add Machines.php"><button>Add Machines</button></a></li>
            <li><a href="Diagnose Machines.php"><button>Diagnose Machines</button></a></li>
            <li><b>WARNING:</b> Deleting a Machine Also Deletes <b>ALL LOGS</b> Corresponding to it<br></li>
        </ul><br>
        
        <table id="machines-table">
            <th>Machine ID</th>
            <th>Machine Name</th>
            <th>Machine Description</th>
            <th>Assigned Jobs</th>

            <?php require '../inc/dbconn.inc.php';

            if(isset($_POST['search'])) {
                $search = "%{$_POST['search']}%";
            }
            else {
                $search = "%";
            }

            $sql = "SELECT Machines.MachineID, MachineName, Description, Decommissioned, GROUP_CONCAT(Jobs.Name SEPARATOR ', ') AS AssignedJobs FROM Machines 
                    LEFT JOIN Jobs ON Machines.MachineID = Jobs.MachineID AND Jobs.Completed = 0
                    WHERE Machines.MachineID LIKE ? OR MachineName LIKE ? OR Description LIKE ? OR Jobs.Name LIKE ?
                    GROUP BY Machines.MachineID;";

            $statement = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($statement, 'ssss', $search, $search, $search, $search);
            if(!mysqli_stmt_execute($statement)) {
                echo(mysqli_error($conn));
                exit;
            }

            $result = mysqli_stmt_get_result($statement);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if($row['Decommissioned'] == 0) {
                        echo("
                            <form method='post' action='./Machine Modification.php'>
                                <tr class='commissioned'>
                                    <td>$row[MachineID]</td>
                                    <td>$row[MachineName]</td>
                                    <td><textarea name='description' autocomplete='off' rows='4' cols='20'>$row[Description]</textarea></td>
                                    <td>$row[AssignedJobs]</td>
                                    <td><input type='submit' name='action' value='Update'></td>
                                    <td><input type='submit' name='action' value='Decommission'></td>
                                    <td><input type='submit' name='action' value='Delete'></td>
                                </tr>
                                <input type='hidden' name='machineID' value='$row[MachineID]'>
                            </form>");
                    }
                    else {
                        echo("
                            <form method='post' action='./Machine Modification.php'>
                                <tr class='decommissioned'>
                                    <td>$row[MachineID]</td>
                                    <td>$row[MachineName]</td>
                                    <td><textarea name='description' autocomplete='off' rows='4' cols='20'>$row[Description]</textarea></td>
                                    <td>$row[AssignedJobs]</td>
                                    <td><input type='submit' name='action' value='Update'></td>
                                    <td><input type='submit' name='action' value='Commission'></td>
                                    <td><input type='submit' name='action' value='Delete'></td>
                                </tr>
                                <input type='hidden' name='machineID' value='$row[MachineID]'>
                            </form>");
                    }
                }
            }

            mysqli_stmt_close($statement);
            mysqli_close($conn);
            ?>
            
        </table>
    </main>
    
</body>
</html>