<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $fullamount = $_POST["fa"];

    $umail = $_SESSION["u"]["email"];
    $fname = $_SESSION["u"]["fname"];
    $lname = $_SESSION["u"]["lname"];
    $mobile = $_SESSION["u"]["mobile"];

    $addrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
    $ar = $addrs->fetch_assoc();
    $cityid = $ar["city"];
    $add = $ar["line1"] . "," . $ar["line2"];
    $districtid = $ar["district_id"];
    $address = $add;

    // $delivery = "0";
    // if ($cityid == "Dankotuwa") {
    //     $delivery = $pr["delivery_fee_dankotuwa"];
    // } elseif ($districtid != 1) {
    //     $delivery = 0;
    // } else {
    //     $delivery = $pr["delivery_fee_other"];
    // }

    $array;

    $orderID = uniqid();

    $cartrs = Database::search("SELECT * FROM `cart` ");
    $can = $cartrs->num_rows;
    $cqty = 0;

    for ($q = 0; $q < $can; $q++) {
        $cr = $cartrs->fetch_assoc();

        $cqty = $cqty + $cr["qty"];
    }

    

    $item = $can." Food items"."(".$cqty."Packs) add to pay..";
  

    $array['id'] = $orderID;
    $array['item'] = $item;
    $array['amount'] = $fullamount;
    $array['fname'] = $fname;
    $array['lname'] = $lname;
    $array['email'] = $umail;
    $array['mobile'] = $mobile;
    $array['address'] = $address;
    $array['city'] = $cityid;
    $array['cqty'] = $cqty;

    echo json_encode($array);
    
}else{
    echo "error";
}
