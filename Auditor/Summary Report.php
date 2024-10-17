<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ben Ellis">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Auditor.css">
    <title>Summary Report</title>
</head>


<body>
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>Summary Report</h1>
        <div id="user-role"><?php DisplayInformation();?></div>
    </header>

    <main>
    <form method="POST">
        <label for="start_date">Start Date:</label>
        <input type="datetime-local" id="start_date" name="start_date" value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>">

        <label for="end_date">End Date:</label>
        <input type="datetime-local" id="end_date" name="end_date" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>">

        <input type="submit" name="submit" value="Fetch Data">
        <br></br>
    </form>

    <?php
    //fetch logs from logs
    require_once "../inc/dbconn.inc.php";

    // Check if the form is submitted
    if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
        // Get the start and end dates from the form
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $start_date = (new DateTime($start_date))->format('Y-m-d H:i:s');
        $end_date = (new DateTime($end_date))->format('Y-m-d H:i:s');

        $sql = "SELECT * 
        FROM `Factory Logs`
        where `timestamp` between ? and ? ";

        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, "ss", $start_date, $end_date);
        if (!mysqli_stmt_execute($statement)) {
            echo(mysqli_error($conn));
            exit;
        }
        $result = mysqli_stmt_get_result($statement);
        mysqli_stmt_close($statement);
        
            if (mysqli_num_rows($result) >= 1 ) {
                echo "<table border='1' id = 'report_table'>
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>machine_name</th>
                        <th>temperature</th>
                        <th>pressure</th>
                        <th>vibration</th>
                        <th>humidity</th>
                        <th>power_consumption</th>
                        <th>operational_status</th>
                        <th>error_code</th>
                        <th>production_count</th>
                        <th>maintenance_log</th>
                        <th>speed</th>
                    </tr>
                </thead>
                <tbody>";
                
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    foreach ($row as $cell) {
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                    }
                    echo "</tr>";
                }
        
                echo "</tbody></table>";
                mysqli_free_result($result);
            } else {
                echo "No records found.";
            } 
        
    }
    mysqli_close($conn);
    ?>
    </main>
</body>