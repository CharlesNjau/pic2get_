<?php
define("DB_SERVER", "195.8.222.39");
define("DB_USER", "pick2get");
define("DB_PASSWORD", "3DZX5J8k");
define("DB_DATABASE", "pick2get");


$servername = "localhost";
$username = "pick2get";
$password = "3DZX5J8k";
$dbname = "pick2get_pick2get";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";


?>