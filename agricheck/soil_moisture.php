<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include 'db_connection.php';

// Fetch latest soil moisture reading
$query = "SELECT soil_moisture, moisture_status, created_at FROM sensor_readings ORDER BY id DESC LIMIT 1";
$result = $conn->query($query);
$row = mysqli_fetch_assoc($result);

if ($row) {
    $moisture = $row['soil_moisture'];
    $status = $row['moisture_status'];
    $timestamp = date('H:i:s', strtotime($row['created_at']));
} else {
    $moisture = "N/A";
    $status = "No Data";
    $timestamp = "--:--:--";
}

// Determine crop suggestion
$crop_suggestion = "";
$crop_image = "";
if ($status == "Dry") {
    $crop_suggestion = "Drought-resistant crops like Millet or Sorghum";
    $crop_image = "millet.jpg";
} elseif ($status == "Moist") {
    $crop_suggestion = "Ideal for crops like Wheat or Maize";
    $crop_image = "wheat.jpg";
} elseif ($status == "Wet") {
    $crop_suggestion = "Best for crops like Rice or Sugarcane";
    $crop_image = "rice.jpg";
} else {
    $crop_suggestion = "No data available";
    $crop_image = "no-data.jpg";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soil Moisture Test</title>
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
        <h2>Soil Moisture Test</h2>
        <h3>Soil Moisture Status (Latest Reading at <?php echo $timestamp; ?>)</h3>
        <p><strong>Soil Moisture:</strong> <?php echo $moisture; ?> (<?php echo $status; ?>)</p>
        <h3>Suggested Crop:</h3>
        <p><?php echo $crop_suggestion; ?></p>
        <img src="<?php echo $crop_image; ?>" alt="Crop Image" class="crop-img">
        <button class="test-btn" onclick="location.reload();">Test Again</button>
        <button class="back-btn" onclick="window.location.href='homepage.php';">Back to Homepage</button>
    </div>
</body>
</html>