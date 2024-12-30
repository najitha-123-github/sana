<?php
session_start(); // Ensure this is at the very top to access session variables

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "complainreg"; // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to validate and sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Check if the required POST parameters are set
if (isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['userid'])) {
    // Sanitize inputs
    $latitude = sanitizeInput($_POST['latitude']);
    $longitude = sanitizeInput($_POST['longitude']);
    $userid = sanitizeInput($_POST['userid']);

    echo "Received Data - Latitude: $latitude, Longitude: $longitude, User ID: $userid<br>";

    // Validate the latitude and longitude values
    if (is_numeric($latitude) && is_numeric($longitude) && is_numeric($userid)) {
        // Prepare SQL statement to insert location data along with userid into the database
        $stmt = $conn->prepare("INSERT INTO locations (userid, latitude, longitude) VALUES (?, ?, ?)");

        // Check if statement preparation was successful
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("idd", $userid, $latitude, $longitude); // "i" for integer (userid), "d" for double (latitude, longitude)

        // Execute SQL statement
        if ($stmt->execute()) {
            echo "Location and user ID saved successfully.";
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: Invalid latitude, longitude, or user ID format.<br>";
    }
} else {
    // Handle case when POST data is missing
    echo "Error: Missing latitude, longitude, or userid.<br>";

    // Show the variables to debug
    echo "Latitude: " . (isset($_POST['latitude']) ? $_POST['latitude'] : 'Not set') . "<br>";
    echo "Longitude: " . (isset($_POST['longitude']) ? $_POST['longitude'] : 'Not set') . "<br>";
    echo "User ID: " . (isset($_POST['userid']) ? $_POST['userid'] : 'Not set') . "<br>";
}

// Close the database connection
$conn->close();
?>
