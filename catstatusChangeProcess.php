<?php
require "connection.php";

$category = $_GET["p"];

$catstatusrs = Database::search("SELECT * FROM `category` WHERE `id`='" . $category . "'");
$catsn = $catstatusrs->num_rows;

if ($catsn == 1) {
    $catsd = $catstatusrs->fetch_assoc();
    $catstatus_id = $catsd["status_id"];

    if ($catstatus_id == 1) {
        Database::iud("UPDATE `category` SET `status_id`=2 WHERE `id`='" . $category . "'");
        echo "deactive";
    } elseif ($catstatus_id == 2) {
        Database::iud("UPDATE `category` SET `status_id`=1 WHERE `id`='" . $category . "'");
        echo "active";
    }
    // echo "success";
} else {
    echo "Error";
}

?>