<?php
// Start session for error or success messages
session_start();

$servername = "localhost";
$db_username = "root"; // Your MySQL username
$db_password = ""; // Your MySQL password
$dbname = "agricheck"; // Your database name

// Create connection to the database
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the password and confirm password match
    if ($password != $confirm_password) {
        $_SESSION['error'] = "Passwords do not match!";
    } else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        // Prepare the SQL query to check if the username already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the username already exists
        if ($result->num_rows > 0) {
            $_SESSION['error'] = "Username already exists!";
        } else {
            // Prepare the SQL query to insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);
            if ($stmt->execute()) {
                $_SESSION['success'] = "User registered successfully!";
            } else {
                $_SESSION['error'] = "Error: " . $stmt->error;
            }
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AgriCheck</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="wrapper">
        <form method="POST" action="register.php">
            <h1>Register</h1>
            
            <?php
            // Display error or success message
            if (isset($_SESSION['error'])) {
                echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo "<p style='color: green;'>" . $_SESSION['success'] . "</p>";
                unset($_SESSION['success']);
            }
            ?>
            
            <div class="input-box">
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="input-box">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
            </div>

            <button type="submit" class="btn">Register</button>

            <div class="login-link">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </form>
    </div>
</body>
</html>
