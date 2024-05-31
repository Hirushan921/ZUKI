<?php
require "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];

    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $mobile = $_POST["m"];
    $line1 = $_POST["a1"];
    $line2 = $_POST["a2"];
    $district = $_POST["d"];
    $city = $_POST["c"];

    // $img = $_FILES["i"]["name"];

    if (empty($fname)) {
        echo "Please enter your first name";
    } elseif (strlen($fname) > 50) {
        echo "First name must be less than 50 characters";
    } elseif (empty($lname)) {
        echo "Please enter your last name";
    } elseif (strlen($lname) > 50) {
        echo "Last name must be less than 50 characters";
    } elseif (empty($mobile)) {
        echo  "Please enter your mobile";
    } elseif (strlen($mobile) != 10) {
        echo  "Please enter 10 digit mobile number";
    } elseif (preg_match("/07[0,1,2,,4,5,6,7,8][0-9]+/", $mobile) == 0) {
        echo  "Invalid mobile number";
    } elseif (empty($line1)) {
        echo "Please enter your address line 01";
    } elseif (empty($line2)) {
        echo "Please enter your address line 02";
    } elseif ($district == "0") {
        echo "Please enter your district";
    } elseif (empty($city)) {
        echo "Please enter your city";
    } else {
        Database::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile`='" . $mobile . "' WHERE `email`='" . $email . "'");

        Database::iud("UPDATE `user_has_address` SET `line1`='" . $line1 . "',`line2`='" . $line2 . "',`city`='" . $city . "',`district_id`='".$district."'
         WHERE `user_email`='" . $email . "'");

        $result=Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
        $s=$result->fetch_assoc();
        $_SESSION["u"] = $s;

        echo "Updated Success";
    }
}
