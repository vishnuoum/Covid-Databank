<?php
$servername = "localhost";
$username = "breakthechainUser";
$password = "Y3dYJ86LCZ5hrGhL";
$dbname = "breakthechainDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>