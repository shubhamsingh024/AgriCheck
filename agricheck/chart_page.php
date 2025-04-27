<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "agricheck");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get latest 10 sensor readings
$sql = "SELECT created_at, soil_moisture, rain_status FROM sensor_readings ORDER BY created_at DESC LIMIT 10";
$result = $conn->query($sql);

$timeLabels = [];
$soilData = [];
$rainData = [];

while ($row = $result->fetch_assoc()) {
    $timeLabels[] = date("H:i:s", strtotime($row['created_at'])); // Convert timestamp to HH:MM:SS format
    $soilData[] = (int)$row['soil_moisture'];
    $rainData[] = (int)$row['rain_status'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensor Data Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js -->
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            margin-top: 30px;
        }
        canvas {
            max-width: 100%;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Sensor Data Chart</h2>
    <canvas id="sensorChart"></canvas> <!-- Chart Canvas -->

    <script>
        var ctx = document.getElementById('sensorChart').getContext('2d');
        var sensorChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($timeLabels); ?>,
                datasets: [{
                    label: 'Soil Moisture',
                    data: <?php echo json_encode($soilData); ?>,
                    borderColor: 'green',
                    borderWidth: 2,
                    fill: false
                }, {
                    label: 'Rain Intensity',
                    data: <?php echo json_encode($rainData); ?>,
                    borderColor: 'blue',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Time (HH:MM:SS)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Sensor Value'
                        }
                    }
                }
            }
        });
    </script>

    <br>
    <a href="dashboard.php">Go Back</a> <!-- Change this link to match your navigation -->
</div>

</body>
</html>
