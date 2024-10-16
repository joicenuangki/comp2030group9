<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ben Ellis" />
    <link rel="stylesheet" href="../Styles/Style.css">
    <title>Dashboard</title>

    <style>
        canvas {
            border: 1px solid black;
        }
    </style>

</head>
<body>
    <header>
        <h1>Dashboard</h1>
    </header>
    
    <form method="POST" id="dataForm">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        
        <label for="machine">Machine:</label>
        <select name="machine" id="machine">
        <?php
        require_once "../inc/dbconn.inc.php";

            // get options
            $sql = "SELECT MachineName FROM Machines";
            $result = $conn->query($sql);

            // Output options
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['MachineName'] . '">' . $row['MachineName'] . '</option>';
                }
            } else {
                echo '<option>No options available</option>';
            }
            ?>
        </select>
        <label for="metric">Metric:</label>
        <select name="metric" id="metric">
        <?php
        // get options
            $sql = "SHOW COLUMNS FROM `Factory Logs`";
            $result = $conn->query($sql);

            //exlude name and timestamp
            $exclude_columns = ['timestamp', 'machine_name', 'operation_status', 'maintenance_log', 'error_code'];

            // Output options
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if (!in_array($row['Field'], $exclude_columns)) {
                       echo '<option value="' . $row['Field'] . '">' . $row['Field'] . '</option>';
                    }
                }
            } else {
                echo '<option>No options available</option>';
            }
            ?>
        </select>
        <input type="submit" name="submit" value="Fetch Data">
        <br></br>
    </form>

    <?php
    if (isset($_POST['date']) && isset($_POST['machine']) && isset($_POST['metric'])) {
        $day = $_POST['date'];
        //convert day to timestamps
        $startOfDay = strtotime($day . ' 00:00:00');
        $endOfDay = strtotime($day . ' 23:30:00');
        //format timestamps
        $startOfDay = date('Y-m-d H:i', $startOfDay);
        $endOfDay = date('Y-m-d H:i', $endOfDay);
        $machine = $_POST['machine'];
        $metric = $_POST['metric']; 
        

        //fetch logs from logs
        $sql = "SELECT `timestamp`, $metric
        FROM `Factory Logs`
        WHERE machine_name = '$machine' and `timestamp` BETWEEN  '$startOfDay' and '$endOfDay'
        ORDER BY timestamp ASC"; 
        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) >= 1 ) {
                $data = [];
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = [
                        'timestamp' => $row['timestamp'],
                        $metric => $row[$metric]
                    ];
                    
            } 
            $jsonData = json_encode($data);
        }
            else {
                echo "No records found.";
            }
        }
    }
?>

<canvas id="myCanvas" width="800" height="400"></canvas>

<script>
    <?php 
        if (isset($jsonData)) {
            echo "const data = $jsonData;";
            echo "const metricName = JSON.parse('". json_encode($metric), "');";
        } else {
            echo "const data = [];";
            echo "const metricName = '';";
        }
    ?>

    if (data.length === 0) {
        //alert("No data available to display.");
    } else {
        const canvas = document.getElementById('myCanvas');
        const ctx = canvas.getContext('2d');

        // Prepare data for plotting
        const timestamps = data.map(entry => new Date(entry.timestamp).toLocaleTimeString());
        const metric = data.map(entry => entry[metricName]);
        
        // Graph dimensions
        const graphHeight = 300;
        const graphWidth = 700;
        const startX = 50;  // Starting X position for the graph
        const startY = 350; // Starting Y position for the graph
        const maxY = Math.max(...metric) * 1.1; // A little padding for Y-axis

        function drawGraph() {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Draw the axes
            ctx.beginPath();
            ctx.moveTo(startX, startY); // X-axis
            ctx.lineTo(startX + graphWidth, startY);
            ctx.moveTo(startX, startY); // Y-axis
            ctx.lineTo(startX, startY - graphHeight);
            ctx.strokeStyle = 'black'; // Ensure the axis lines are visible
            ctx.lineWidth = 1;
            ctx.stroke();

            // Y-axis labels
            ctx.font = '12px Arial';
            ctx.textAlign = 'right';
            ctx.fillStyle = 'black';
            for (let i = 0; i <= 5; i++) {
                const label = (i * maxY / 5).toFixed(1); // Dividing into 5 segments
                const y = startY - (i * graphHeight / 5);
                ctx.fillText(label, startX - 10, y + 4); // Add some padding for text
                ctx.beginPath();
                ctx.moveTo(startX - 5, y); // Draw tick marks
                ctx.lineTo(startX, y);
                ctx.stroke();
            }

            // X-axis
            ctx.textAlign = 'center';
            const skipLabels = Math.ceil(timestamps.length / 15); // Only show every nth timestamp

            for (let i = 0; i < timestamps.length; i++) {
                if (i % skipLabels === 0) { // Only draw every nth label
                    const x = startX + (i * (graphWidth / (timestamps.length - 1)));
                    ctx.fillText(timestamps[i], x, startY + 20); // Positioning the timestamps
                }
            }

            ctx.beginPath();
            ctx.moveTo(startX, startY - (metric[0] * graphHeight / maxY)); // Start at the first point

            for (let i = 0; i < metric.length; i++) {
                const x = startX + (i * (graphWidth / (metric.length - 1)));
                const y = startY - (metric[i] * graphHeight / maxY); // Scale metric to fit graph height
                ctx.lineTo(x, y);  // Line from previous point to current point
            }

            ctx.strokeStyle = 'blue';  // Ensure the line is visible (blue color)
            ctx.lineWidth = 2;         // Set a thicker width for the line
            ctx.stroke();              // Draw the line

            // Now draw data points and labels **after** drawing the line
            for (let i = 0; i < metric.length; i++) {
                const x = startX + (i * (graphWidth / (metric.length - 1)));
                const y = startY - (metric[i] * graphHeight / maxY);

                // Draw data points as circles
                ctx.beginPath();
                ctx.arc(x, y, 3, 0, 2 * Math.PI);
                ctx.fillStyle = 'blue';  // Fill the circles blue
                ctx.fill();
                ctx.stroke();

                // Label metric at each point
                ctx.fillStyle = 'black'; // Label color
                ctx.fillText(metric[i], x, y - 10); // Display metric value above the point
            }
        }  
    drawGraph();
    }
</script>


    <main>


    </main>
</body>
</html>