<?php
$servername = getenv('DB_HOST') ?: "localhost";
$username = getenv('DB_USERNAME') ?: (getenv('DB_USER') ?: "root");
$password = getenv('DB_PASSWORD') ?: "";
$dbname = getenv('DB_NAME') ?: "student-test"; // DB name
$port = (int) (getenv('DB_PORT') ?: 3306);

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>  
