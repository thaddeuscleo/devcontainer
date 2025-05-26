<?php

echo "<h1>Hello</h1>";

$host = '192.168.0.70';  // Assuming ProxySQL is running locally
$port = 6033;         // ProxySQL MySQL connection port
$dbname = 'testdb';
$username = 'testuser';
$password = 'testpassword';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data
$sql = "SELECT name, email FROM names";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data in table format
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Email</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . htmlspecialchars($row["name"]) . "</td><td>" . htmlspecialchars($row["email"]) . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}

// Close connection
$conn->close();
?>

