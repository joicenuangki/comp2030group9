<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ben" />
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
    
    <?php
        //fetch logs from logs
        require_once "../inc/dbconn.inc.php";

        $sql = "SELECT timestamp, speed FROM `Factory Logs` ORDER BY timestamp ASC";

        $sql = "SELECT `timestamp`, production_count 
        FROM `Factory Logs`
        WHERE machine_name = 'CNC Machine' 
        ORDER BY timestamp ASC"; 

        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) >= 1 ) {
                $data = [];
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = [
                        'timestamp' => $row['timestamp'],
                        'production_count' => $row['production_count']
                    ];
                    
            } 
            $jsonData = json_encode($data);
        }
            else {
                echo "No records found.";
            }
        }
?>

<canvas id="myCanvas" width="800" height="400"></canvas>

<script>
    <?php 
        if (isset($jsonData)) {
            echo "const data = $jsonData;";
        } else {
            echo "const data = [];";
        }
    ?>

    if (data.length === 0) {
        alert("No data available to display.");
    } else {
        const canvas = document.getElementById('myCanvas');
        const ctx = canvas.getContext('2d');

        // Prepare data for plotting
        const timestamps = data.map(entry => new Date(entry.timestamp).toLocaleTimeString());
        const counts = data.map(entry => entry.production_count);

        // Graph dimensions
        const graphHeight = 300;
        const graphWidth = 700;
        const startX = 50;  // Starting X position for the graph
        const startY = 350; // Starting Y position for the graph
        const maxY = Math.max(...counts) * 1.1; // A little padding for Y-axis

        // Function to draw the graph
        function drawGraph() {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Draw axes
            ctx.beginPath();
            ctx.moveTo(startX, startY); // X-axis
            ctx.lineTo(startX + graphWidth, startY);
            ctx.moveTo(startX, startY); // Y-axis
            ctx.lineTo(startX, startY - graphHeight);
            ctx.strokeStyle = 'black'; // Ensure the axis lines are visible
            ctx.lineWidth = 1;
            ctx.stroke();

            // Y-axis labels (counts values)
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

            // X-axis labels (timestamps)
            ctx.textAlign = 'center';
            const skipLabels = Math.ceil(timestamps.length / 10); // Only show every 10th timestamp (adjust this value as needed)

            for (let i = 0; i < timestamps.length; i++) {
                if (i % skipLabels === 0) { // Only draw every nth label
                    const x = startX + (i * (graphWidth / (timestamps.length - 1)));
                    ctx.fillText(timestamps[i], x, startY + 20); // Positioning the timestamps
                }
            }

            // ** Draw the graph line before points **
            ctx.beginPath();
            ctx.moveTo(startX, startY - (counts[0] * graphHeight / maxY)); // Start at the first point

            for (let i = 0; i < counts.length; i++) {
                const x = startX + (i * (graphWidth / (counts.length - 1)));
                const y = startY - (counts[i] * graphHeight / maxY); // Scale counts to fit graph height
                ctx.lineTo(x, y);  // Line from previous point to current point
            }

            ctx.strokeStyle = 'blue';  // Ensure the line is visible (blue color)
            ctx.lineWidth = 2;         // Set a thicker width for the line
            ctx.stroke();              // Draw the line

            // Now draw data points and labels **after** drawing the line
            for (let i = 0; i < counts.length; i++) {
                const x = startX + (i * (graphWidth / (counts.length - 1)));
                const y = startY - (counts[i] * graphHeight / maxY);

                // Draw data points as circles
                ctx.beginPath();
                ctx.arc(x, y, 3, 0, 2 * Math.PI);
                ctx.fillStyle = 'blue';  // Fill the circles blue
                ctx.fill();
                ctx.stroke();

                // Label counts at each point
                ctx.fillStyle = 'black'; // Label color
                ctx.fillText(counts[i], x, y - 10); // Display counts value above the point
            }
        }

        drawGraph();
    }
</script>


    <main>


    </main>
</body>
</html>