<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $oid = $_POST["oid"];
    $email = $_POST["email"];
    $total = $_POST["total"];
    $cfqty = $_POST["cfqty"];

    $oneprice  = $total / $cfqty;


    $d = new DateTime();
    $tz = new DateTimeZone("ASia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $scartrs = Database::search("SELECT * FROM `cart`");
    $scn = $scartrs->num_rows;



    for ($e = 0; $e < $scn; $e++) {
        $scr = $scartrs->fetch_assoc();
        $product_id = $scr["product_id"];
        $qty = $scr["qty"];
        $inprice = $oneprice * $qty;

        // echo $oid;
        // echo $product_id;
        // echo $email;
        // echo $inprice;
        // echo $date;
        // echo $qty;
        // echo "<br/>";

        Database::iud("INSERT INTO `invoice`(`order_id`,`product_id`,`user_email`,`date`,`total`,`qty`,`status_id`) 
        VALUES('" . $oid . "','" . $product_id . "','" . $email . "','" . $date . "','" . $inprice . "','" . $qty . "','1')");

        // echo "success";

        $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $product_id . "'");
        $pn = $productrs->fetch_assoc();
    
        $pqty = $pn["qty"];
        $newqty = $pqty - $qty;
    
        Database::iud("UPDATE `product` SET `qty`='" . $newqty . "' WHERE `id`='" . $product_id . "'");

        Database::iud("DELETE FROM `cart`");

    }

    
}
