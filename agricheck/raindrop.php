<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include 'db_connection.php';

// Fetch latest raindrop sensor reading
$query = "SELECT raindrop, rain_status, created_at FROM sensor_readings ORDER BY id DESC LIMIT 1";
$result = $conn->query($query);
$row = mysqli_fetch_assoc($result);

if ($row) {
    $raindrop = $row['raindrop'];
    $status = $row['rain_status'];
    $timestamp = date('H:i:s', strtotime($row['created_at']));
} else {
    $raindrop = "N/A";
    $status = "No Data";
    $timestamp = "--:--:--";
}

// Determine crop suggestion
$crop_suggestion = "";
$crop_image = "";
if ($status == "No Rain") {
    $crop_suggestion = "Drought-resistant crops like Millet or Chickpeas";
    $crop_image = "millet.jpg";
} elseif ($status == "Light Rain") {
    $crop_suggestion = "Suitable for crops like Corn or Vegetables";
    $crop_image = "corn.jpg";
} elseif ($status == "Heavy Rain") {
    $crop_suggestion = "Best for water-intensive crops like Rice or Sugarcane";
    $crop_image = "rice.jpg";
} else {
    $crop_suggestion = "No data available";
    $crop_image = "images/no-data.jpg";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raindrop Sensor Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }
        .container {
            margin: 100px auto; 
            padding: 20px; 
            border-radius: 10px; 
            background: rgba(0, 0, 0, 0.7); 
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1); 
            max-width: 500px;
        }
        button {
            padding: 10px 20px; 
            margin: 10px; 
            border: none; 
            cursor: pointer; 
            font-size: 16px;
        }
        .test-btn { background: blue; color: white; border-radius: 5px; }
        .back-btn { background: red; color: white; border-radius: 5px; }
        .crop-img { width: 100%; max-width: 300px; border-radius: 10px; margin-top: 15px; }
    </style>
    <script>
        setTimeout(function() {
            location.reload();
        }, 5000);
    </script>
</head>
<body>
    <div class="container">
        <h2>Raindrop Sensor Test</h2>
        <h3>Rain Status (Latest Reading at <?php echo $timestamp; ?>)</h3>
        <p><strong>Raindrop Value:</strong> <?php echo $raindrop; ?> (<?php echo $status; ?>)</p>
        <h3>Suggested Crop:</h3>
        <p><?php echo $crop_suggestion; ?></p>
        <img src="<?php echo $crop_image; ?>" alt="Crop Image" class="crop-img">
        <button class="test-btn" onclick="location.reload();">Test Again</button>
        <button class="back-btn" onclick="window.location.href='homepage.php';">Back to Homepage</button>
    </div>
</body>
</html>
