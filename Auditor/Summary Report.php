<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ben">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Style.css">
    <title>Summary Report</title>
</head>

<body>
    <header>
        <?php include '../inc/header.inc.php';?>
        <h1>Summary Report</h1>
    </header>

    <main>
    <form method="POST">
        <label for="start_date">Start Date:</label>
        <input type="datetime-local" id="start_date" name="start_date" required>
        
        <label for="end_date">End Date:</label>
        <input type="datetime-local" id="end_date" name="end_date" required>

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

        $sql = "SELECT * 
        FROM `Factory Logs`
        where 'timestamp' between '$start_date' and '$end_date' ";
        
        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) >= 1 ) {
                
                echo "<ul>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>" . implode(" - ", $row) . "</li>";
                } echo "</ul>";
                mysqli_free_result($result);

            } else {
                echo "No records found.";
            }
        }
    }
    mysqli_close($conn);
    ?>
    </main>
</body>