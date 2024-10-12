<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once "../inc/loggedin.inc.php"; 
    FactoryManagerCheck();?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Factoy Manager.css">
    <title>View Machines</title>
</head>
<body>
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>View Machines</h1>
        <div id="user-role"><?php DisplayInformation();?></div>
    </header>
    <main>
        <a href="./Machines.php"><button>Back to Machine Overview</button></a>
        <table id="view-machines-table">
            <th>Machine ID</th>
            <th>Machine Name</th>
            <th>Machine Description</th>
            <th></th>
            <th></th>

            <?php require_once '../inc/dbconn.inc.php';

            $sql = "SELECT MachineID, MachineName, Description, Decommissioned FROM Machines";

            $statement = mysqli_prepare($conn, $sql);
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
                                    <td><input type='text' name='description' value='$row[Description]'></td>
                                    <td><input type='submit' name='action' value='Update'></td>
                                    <td><input type='submit' name='action' value='Decommission'></td>
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
                                    <td><input type='text' name='description' value='$row[Description]'></td>
                                    <td><input type='submit' name='action' value='Update'></td>
                                    <td><input type='submit' name='action' value='Commission'></td>
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