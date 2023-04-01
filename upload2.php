<?php
session_start();
include "dbconnect.php";

if (!empty($_FILES)) {
    $file = $_FILES['file'];
    $targetDir = "videos/";
    $tribe = $_POST['tribe'];
    $size=$_FILES['file']['size'];
    $clan = $_POST['clan'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $uploaded_by = $_SESSION['user']['user_id'];
    $targetFile = $targetDir.time().basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        $sql = "INSERT INTO `video`(`title`, `description`, `tribe`, `clan`, `video_size`, `uploaded_by`) 
        VALUES ('$title', '$description', '$tribe', '$clan', '$size', '$uploaded_by')";
        $results = $conn->query($sql);
        if ($results) {
            $username =  $_SESSION['user']['username'];
            $transaction_id = "#" . date('Ym') . time();
            $sql = "INSERT INTO `logs`(`transaction_id`, `transaction_type`, `user`) VALUES ('$transaction_id', 'Added new animated video into the system', '$username')";
            $conn->query($sql);
        }
    }
}
