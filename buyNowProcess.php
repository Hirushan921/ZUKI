<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $id = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["u"]["email"];

    $array;

    $orderID = uniqid();

    $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $id . "'");
    $pr = $productrs->fetch_assoc();

    $cityrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
    $cn = $cityrs->num_rows;


    if ($cn == 1) {
        $cr = $cityrs->fetch_assoc();
        $cityid = $cr["city"];
        $add = $cr["line1"] . "," . $cr["line2"];

        $districtid = $cr["district_id"];

        $delivery = "0";
        if ($cityid == "Dankotuwa" || $cityid == "dankotuwa") {
            $delivery = $pr["delivery_fee_dankotuwa"];
        } elseif ($districtid != 1) {
            $delivery = 0;
        } else {
            $delivery = $pr["delivery_fee_other"];
        }

        $item = $pr["title"];
        $amount = $pr["price"] * $qty + (int)$delivery;

        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $address = $add;
        // $city = $dr["name"];

        $array['id'] = $orderID;
        $array['item'] = $item;
        $array['amount'] = $amount;
        $array['fname'] = $fname;
        $array['lname'] = $lname;
        $array['email'] = $umail;
        $array['mobile'] = $mobile;
        $array['address'] = $address;
        $array['city'] = $cityid;

        echo json_encode($array);
    } else {
        echo "2";
    }
} else {
    echo "1";
}
