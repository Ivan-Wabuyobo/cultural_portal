<?php
$conn = new mysqli("localhost","root","admin","portal");
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
  }
?>