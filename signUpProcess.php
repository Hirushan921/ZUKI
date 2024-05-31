<?php

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];
$line1 = $_POST["line1"];
$line2 = $_POST["line2"];
$city = $_POST["city"];
$district = $_POST["district"];



if (empty($fname)) {
    echo "Please enter your first name";
} elseif (strlen($fname) > 50) {
    echo "First name must be less than 50 characters";
} elseif (empty($lname)) {
    echo "Please enter your last name";
} elseif (strlen($lname) > 50) {
    echo "Last name must be less than 50 characters";
} elseif (empty($email)) {
    echo  "Please enter your email";
} elseif (strlen($email) > 100) {
    echo "email must be less than 100 characters";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo  "Invalid email address";
} elseif (empty($password)) {
    echo  "Please enter your password";
} elseif (strlen($password) < 5 || strlen($password) > 20) {
    echo  "Password length must between 5 to 20";
} elseif (empty($mobile)) {
    echo  "Please enter your mobile";
} elseif (strlen($mobile) != 10) {
    echo  "Please enter 10 digit mobile number";
} elseif ($gender == "0") {
    echo "Please select your gender";
} elseif (empty($line1)) {
    echo "Please enter your address line 01";
} elseif (empty($line2)) {
    echo "Please enter your address line 02";
} elseif (empty($city)) {
    echo "Please enter your city";
} elseif ($district == "0") {
    echo "Please select your district";
} elseif (preg_match("/07[0,1,2,,4,5,6,7,8][0-9]+/", $mobile) == 0) {
    echo  "Invalid mobile number";
} else {
    include "connection.php";

    $r = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' OR `mobile`='" . $mobile . "'");
    if ($r->num_rows > 0) {
        echo  "User with the same email address or mobile number already exists";
    } else {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        $status = "1";

        Database::iud("INSERT INTO user(`email`,`fname`,`lname`,`password`,`mobile`,`register_date`,`gender_id`,`status_id`) 
        VALUES('" . $email . "','" . $fname . "','" . $lname . "','" . $password . "','" . $mobile . "','" . $date . "','" . $gender . "','" . $status . "')");

        Database::iud("INSERT INTO `user_has_address`(`user_email`,`line1`,`line2`,`city`,`district_id`) 
        VALUES('" . $email . "','" . $line1 . "','" . $line2 . "','" . $city . "','".$district."')");

        echo "success";
    }
}
