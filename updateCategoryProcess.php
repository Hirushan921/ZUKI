<?php

require "connection.php";
session_start();

$cid = $_POST["cid"];

$imgsearch = Database::search("SELECT * FROM `category` WHERE `id`='" . $cid . "'");
$in = $imgsearch->num_rows;

if ($in >= 1) {
    // update 

    if (isset($_FILES["img"])) {
        $imageFile = $_FILES["img"];
        $fileNewName = $_FILES["img"]["name"];

        $allowed_image_extension = array("jpg", "png", "svg");  // Allow karana img files
        $file_extension = pathinfo($fileNewName, PATHINFO_EXTENSION);  // img eke extension

        // echo $file_extension = $image["type"];

        if (!in_array($file_extension, $allowed_image_extension)) {
            echo "Please Select a Valid Image";
        } else {
            // echo $imageFile["name"];
            $fileName = "resources/foodimage//" . uniqid() . "." . $file_extension;
            move_uploaded_file($imageFile["tmp_name"], $fileName);

            Database::iud("UPDATE `category` SET `code`='" . $fileName . "' WHERE `id`='" . $cid . "'");

            echo "success";
        }
    }
}
