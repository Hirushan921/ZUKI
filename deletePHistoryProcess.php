<?php
require "connection.php";
session_start();

if(isset($_SESSION["u"])){

$phid = $_GET["id"];
// echo $phid;
$email = $_SESSION["u"]["email"];

$inrs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='".$phid."' AND `user_email`='".$email."'");
$in = $inrs->num_rows;


if($in==1){
    Database::iud("UPDATE `invoice` SET `status_id`='2' WHERE `order_id`='".$phid."'");
    echo "success";
}else{
 
    echo "error";
}


}
?>