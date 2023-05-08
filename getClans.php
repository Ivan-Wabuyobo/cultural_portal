<?php
include 'dbconnect.php';
$tribeId = $_GET['tribe'];
$sql = "SELECT * FROM `clans` WHERE  tribe_id = '$tribeId'";
$results = $conn->query($sql);
$data = array();
while ($row = $results->fetch_assoc()) {
    $data[] = $row;
}
// convert the data array to a JSON string
$json = json_encode($data);

echo $json;
?>
