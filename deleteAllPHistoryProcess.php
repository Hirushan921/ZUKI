<?php
require "connection.php";
session_start();

if(isset($_SESSION["u"])){


$email2 = $_SESSION["u"]["email"];





    Database::iud("UPDATE `invoice` SET `status_id`='2' WHERE `user_email`='".$email2."'");
    echo "success";


}
?>