<?php

require "connection.php";
session_start();

$category = (int)$_POST["c"];
$title = $_POST["t"];
$qty = (int)$_POST["qty"];
$price = (int)$_POST["p"];
$dwc = (int)$_POST["dwc"];
$doc = (int)$_POST["doc"];
$description = $_POST["desc"];

// echo $category;
// echo "<br/>";
// echo $brand;
// echo "<br/>";
// echo $model;
// echo "<br/>";
// echo $title;
// echo "<br/>";
// echo $condition;
// echo "<br/>";
// echo $colour;
// echo "<br/>";
// echo $qty;
// echo "<br/>";
// echo $price;
// echo "<br/>";
// echo $dwc;
// echo "<br/>";
// echo $doc;
// echo "<br/>";
// echo $description;


$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$state = 1;
$adminemail =$_SESSION["a"]["email"];

if($category=="0"){
    echo "Please Select a Category.";
}else if(empty($title)){
    echo "Please Add a Title";
}else if(strlen($title)>100){
    echo "Title must contain 100 or more than 100 characters";
}else if($qty=="0" || $qty =="e"){
    echo "Please Add the Quantity Of Your Product.";
}else if(!is_int($qty)){
    echo "Please Add valid Quantity.";
}else if(empty($qty)){
    echo "Please Add Quantity of your Product.";
}else if($qty < 0){
    echo "Please Add a Valid Quantity.";
}else if(empty($price)){
    echo "Please Add the Price of Your Product.";
}else if(!is_int($price)){
    echo "Please Insert a Valid Price.";
}else if(empty($dwc)){
    echo "Please Insert Delivery cost inside Dankotuwa City.";
}else if(!is_int($dwc)){
    echo "Please Insert a Valid Price.";
}else if(empty($doc)){
    echo "Please Insert Delivery cost outside Dankotuwa City.";
}else if(!is_int($doc)){
    echo "Please Insert a Valid Price.";
}else if(empty($description)){
    echo "Please Enter the Decription of Your Product.";
}else{
    

        Database::iud("INSERT INTO `product` 
        (`category_id`,`title`,`price`,`qty`,`description`,`status_id`,`admin_email`,`datetime_added`,`delivery_fee_dankotuwa`,`delivery_fee_other`)
        VALUES
        ('".$category."','".$title."','".$price."','".$qty."','".$description."','".$state."','".$adminemail."','".$date."','".$dwc."','".$doc."');");
    
        echo "done";

     

    
        
    }



?>