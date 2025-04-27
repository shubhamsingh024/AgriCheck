<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Hardware - AgriCheck</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('background.jpg');
            background-size: cover;
            background-position: center;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            padding: 1rem;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar ul li {
            margin: 0 1rem;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
        }

        .content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            text-align: center;
        }

        .content h1, .content p {
            color: black;
        }

        .hardware-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            justify-content: center;
            align-items: center;
        }

        .hardware-item {
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .hardware-item:hover {
            transform: scale(1.05);
        }

        .hardware-item img {
            width: 100%;
            height: auto;
        }

        .hardware-item h3 {
            margin: 0;
            padding: 1rem;
            font-size: 1.2rem;
            text-align: center;
        }

        .hardware-item a {
            display: block;
            text-decoration: none;
            background-color: #28a745;
            color: white;
            padding: 0.5rem 0;
            font-weight: bold;
            text-align: center;
        }

        .hardware-item a:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <img src="logo.png" alt="AgriCheck Logo" class="logo" style="height: 40px;">
        <ul>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="aboutus.html">About Us</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="buyhardware.html">Buy Hardware</a></li>
        </ul>
    </div>

    <div class="content">
        <h1 style="color: black;">Buy Hardware</h1>
        <p style="color: black;">Select hardware for your smart agriculture needs and shop directly on Amazon!</p>

        <div class="hardware-grid">
            <!-- Example hardware items -->
            <div class="hardware-item">
                <img src="soil_sensor.jpg" alt="Soil Moisture Sensor">
                <h3>Soil Moisture Sensor</h3>
                <a href="https://www.amazon.com/example-soil-moisture-sensor" target="_blank">Buy on Amazon</a>
            </div>

            <div class="hardware-item">
                <img src="rain_sensor.jpg" alt="Rain Sensor">
                <h3>Rain Sensor</h3>
                <a href="https://www.amazon.com/example-rain-sensor" target="_blank">Buy on Amazon</a>
            </div>

            <div class="hardware-item">
                <img src="arduino.jpg" alt="Arduino Board">
                <h3>Arduino Board</h3>
                <a href="https://www.amazon.com/example-arduino-board" target="_blank">Buy on Amazon</a>
            </div>

            <div class="hardware-item">
                <img src="resistor.jpg" alt="Resistors">
                <h3>Resistors</h3>
                <a href="https://www.amazon.com/example-resistors" target="_blank">Buy on Amazon</a>
            </div>

            <div class="hardware-item">
                <img src="jumper_wires.jpg" alt="Jumper Wires">
                <h3>Jumper Wires</h3>
                <a href="https://www.amazon.com/example-jumper-wires" target="_blank">Buy on Amazon</a>
            </div>

            <div class="hardware-item">
                <img src="breadboard.jpg" alt="Breadboard">
                <h3>Breadboard</h3>
                <a href="https://www.amazon.com/example-breadboard" target="_blank">Buy on Amazon</a>
            </div>

            <div class="hardware-item">
                <img src="dht11.jpg" alt="DHT11 Sensor">
                <h3>DHT11 Sensor</h3>
                <a href="https://www.amazon.com/example-dht11-sensor" target="_blank">Buy on Amazon</a>
            </div>

            <div class="hardware-item">
                <img src="potentiometer.jpg" alt="Potentiometer">
                <h3>Potentiometer</h3>
                <a href="https://www.amazon.com/example-potentiometer" target="_blank">Buy on Amazon</a>
            </div>
        </div>
    </div>
</body>
</html>
