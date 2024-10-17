<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php"; 
    AdministratorCheck(); ?>
    <meta charset="UTF-8">
    <meta name="author" content="Nathan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Administrator.css">
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
            <li><a href="Diagnose Machines.php"><button>Diagnose Machines</button></a></li>
        </ul><br>
        
        <table id="machines-table">
            <th>Machine ID</th>
            <th>Machine Name</th>
            <th>Machine Description</th>

            <?php require '../inc/dbconn.inc.php';

            if(isset($_POST['search'])) {
                $search = "%{$_POST['search']}%";
            }
            else {
                $search = "%";
            }

            $sql = "SELECT MachineID, MachineName, Description, Decommissioned FROM Machines 
                    WHERE MachineID LIKE ? OR MachineName LIKE ? OR Description LIKE ?
                    GROUP BY MachineID;";

            $statement = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($statement, 'sss', $search, $search, $search);
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
                                    <td><input type='submit' name='action' value='Update'></td>
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
                                    <td><input type='submit' name='action' value='Update'></td>
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