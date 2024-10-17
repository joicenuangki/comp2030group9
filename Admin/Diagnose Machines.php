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
    <title>Diagnose Machines</title>
</head>
<body>
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>Diagnose Machines</h1>
        <div id="user-role"><?php DisplayInformation(); ?></div>
    </header>
    <main>
        <ul id="machines-ul">
            <li><a href="Machines.php"><button>Back to Machines</button></a></li>
        </ul>

        <table id="machines-table">
            <tr>
                <th>Machine ID</th>
                <th>Machine Name</th>
                <th>Error Code</th>
                <th>Maintenance Required</th>
                <th>Time of Error</th>
            </tr>


        <?php
        require "../inc/dbconn.inc.php";

        $sql = "SELECT Machines.MachineID, MachineName, error_code, maintenance_log, timestamp FROM Machines
                JOIN `Factory Logs` ON MachineName = `Factory Logs`.machine_name
                JOIN (
                    SELECT machine_name, MAX(timestamp) AS latest_timestamp FROM `Factory Logs`
                    GROUP BY machine_name) 
                AS LatestLogs ON `Factory Logs`.machine_name = LatestLogs.machine_name 
                AND `Factory Logs`.timestamp = LatestLogs.latest_timestamp
                WHERE `Factory Logs`.operational_status = 'maintenance';";

        $statement = mysqli_prepare($conn, $sql);
        if(!mysqli_stmt_execute($statement)) {
            echo(mysqli_error($conn));
            exit;
        }

        $result = mysqli_stmt_get_result($statement);

        while ($row = mysqli_fetch_assoc($result)) {
            echo("
                <tr>
                    <td>$row[MachineID]</td>
                    <td>$row[MachineName]</td>
                    <td>$row[error_code]</td>
                    <td>$row[maintenance_log]</td>
                    <td>$row[timestamp]</td>
                </tr>
                <input type='hidden' name='machineID' value='$row[MachineID]'>");
        }

        ?>
        </table>
    </main>
</body>
</html>