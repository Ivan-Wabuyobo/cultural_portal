<?php
session_start();
include "dbconnect.php";
$username =  $_SESSION['user']['username'] ;
$transaction_id = "#".date('Ym').time();
$sql = "INSERT INTO `logs`(`transaction_id`, `transaction_type`, `user`) VALUES ('$transaction_id', 'Logged out of the system successfully', '$username')";
$conn->query($sql);

// remove all session variables
session_unset();

//redirect the user to the index page
header("location:login.php");

?>