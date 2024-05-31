<?php

require "connection.php";
session_start();

$cat = $_POST["c"];

$state = 1;

if (empty($cat)) {
    echo "Please Add a Category";
} else if (!isset($_FILES["img"])) {
    echo "Please Select a Image";
}else{

Database::iud("INSERT INTO `category`(`name`,`status_id`) VALUES('".$cat."','".$state."')");

$last_id = Database::$connection->insert_id;

    $imageFile = $_FILES["img"];
    $fileNewName = $_FILES["img"]["name"];

    $allowed_image_extension = array("jpg","png","svg");  // Allow karana img files
    $file_extension = pathinfo($fileNewName, PATHINFO_EXTENSION);  // img eke extension

    // echo $file_extension = $image["type"];

    if(!in_array($file_extension, $allowed_image_extension)){
        echo "Please Select a Valid Image";
    }else{
        // echo $imageFile["name"];
        $fileName = "resources/foodimage//".uniqid().".".$file_extension;
        move_uploaded_file($imageFile["tmp_name"],$fileName);

        Database::iud("UPDATE `Category` SET `code`='".$fileName."' WHERE `id`='".$last_id."'");
    }

    echo "success";
}
