<?php
session_start();
include "dbconnect.php";

if (!empty($_FILES)) {
    $file = $_FILES['file'];
    $size=$_FILES['file']['size'];
    $targetDir = "gallery/";
    $tribe = $_POST['tribe'];
    $clan = $_POST['clan'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $uploaded_by = $_SESSION['user']['user_id'];
    $targetFile = $targetDir.time().basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        $sql = "INSERT INTO `gallery`(`title`, `tribe`, `clan`, `image_name`, `description`, `size`, `uploaded_by`) VALUES ('$title', '$tribe', '$clan', '$targetFile', '$description', '$size', '$uploaded_by')";
        $results = $conn->query($sql);
        if ($results) {
            $username =  $_SESSION['user']['username'];
            $transaction_id = "#" . date('Ym') . time();
            $sql = "INSERT INTO `logs`(`transaction_id`, `transaction_type`, `user`) VALUES ('$transaction_id', 'Added new gallery into the system', '$username')";
            $conn->query($sql);
        }
    }
}
