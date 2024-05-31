<?php
session_start();
require "connection.php";

$from = $_GET["f"];
$to = $_GET["t"];

// echo $from;
// echo $to;
?>

<!DOCTYPE html>

<html>

<head>
    <title>ZUKI | Food Selling History</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/zukilogo.svg" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body style="background-image: linear-gradient(to right top, #bf2742, #c9437e, #c068b4, #a88bdc, #8dabf3);">

    <div class="container-fluid">
        <div class="row">

            <?php
            require "adminheader.php";
            ?>

            <div class="col-12 bg-light text-center rounded">
                <label class="form-label fs-2 fw-bold text-danger">Products Selling History</label>
            </div>

            <div class="hrbreak2"></div>

            <div class="col-12 mt-3 mb-2">
                <div class="row">
                    <div class="col-3 col-lg-2  bg-primary pt-2 pb-2 text-end">
                        <span class="fs-4 fw-bold text-white">Order ID</span>
                    </div>
                    <div class="col-6 col-lg-3 bg-primary pt-2 pb-2">
                        <span class="fs-4 fw-bold text-white">Product</span>
                    </div>
                    <div class="col-6 col-lg-3 bg-primary pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Buyer</span>
                    </div>
                    <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Price</span>
                    </div>
                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 ">
                        <span class="fs-4 fw-bold text-white">Quantity</span>
                    </div>
                </div>
            </div>

            <?php
            if (!empty($from) && empty($to)) {
                $fromrs = Database::search("SELECT * FROM `invoice`");
                $fn = $fromrs->num_rows;

                for ($x = 0; $x < $fn; $x++) {
                    $fr = $fromrs->fetch_assoc();

                    $fromdate = $fr["date"];
                    $splitdate = explode(" ", $fromdate);
                    $date = $splitdate[0];

                    if ($from == $date) {
            ?>
                        <div class="col-12 mb-2">
                            <div class="row">
                                <div class="col-3 col-lg-2 bg-white pt-2 pb-2 text-end border border-start-0 border-top-0 border-end border-bottom-0 border-primary border-2">
                                    <span class="fs-5 fw-bold text-dark"><?php echo $fr["order_id"]; ?></span>
                                </div>
                                <?php
                                $prors = Database::search("SELECT * FROM `product` WHERE `id`='" . $fr["product_id"] . "'");
                                $pro = $prors->fetch_assoc();
                                ?>
                                <div class="col-6 col-lg-3 bg-white pt-2 pb-2 border border-start-0 border-top-0 border-end border-bottom-0 border-primary border-2">
                                    <span class="fs-5 fw-bold text-dark"><?php echo $pro["title"]; ?></span>
                                </div>
                                <?php
                                $userrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $fr["user_email"] . "'");
                                $us = $userrs->fetch_assoc();
                                ?>
                                <div class="col-6 col-lg-3 bg-white pt-2 pb-2 d-none d-lg-block border border-start-0 border-top-0 border-end border-bottom-0 border-primary border-2">
                                    <span class="fs-5 fw-bold text-dark"><?php echo $us["fname"] . " " . $us["lname"]; ?></span>
                                </div>
                                <div class="col-2 bg-white pt-2 pb-2 d-none d-lg-block border border-start-0 border-top-0 border-end border-bottom-0 border-primary border-2">
                                    <span class="fs-5 fw-bold text-dark">Rs. <?php echo $fr["total"]; ?>.00</span>
                                </div>
                                <div class="col-3 col-lg-2 bg-white pt-2 pb-2 ">
                                    <span class="fs-5 fw-bold text-dark"><?php echo $fr["qty"]; ?></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
            } elseif (!empty($from) && !empty($to)) {
                $betweenrs = Database::search("SELECT * FROM `invoice`");
                $bn = $betweenrs->num_rows;


                for ($y = 0; $y < $bn; $y++) {
                    $br = $betweenrs->fetch_assoc();

                    $betweendate = $br["date"];
                    $splitdate = explode(" ", $betweendate);
                    $date = $splitdate[0];

                    if ($from <= $date && $to >= $date) {
                    ?>
                        <div class="col-12 mb-2">
                            <div class="row">
                                <div class="col-3 col-lg-2 bg-white pt-2 pb-2 text-end border border-start-0 border-top-0 border-end border-bottom-0 border-primary border-2">
                                    <span class="fs-5 fw-bold text-dark"><?php echo $br["order_id"]; ?></span>
                                </div>
                                <?php
                                $prors2 = Database::search("SELECT * FROM `product` WHERE `id`='" . $br["product_id"] . "'");
                                $pro2 = $prors2->fetch_assoc();
                                ?>
                                <div class="col-6 col-lg-3 bg-white pt-2 pb-2 border border-start-0 border-top-0 border-end border-bottom-0 border-primary border-2">
                                    <span class="fs-5 fw-bold text-dark"><?php echo $pro2["title"]; ?></span>
                                </div>
                                <?php
                                $userrs2 = Database::search("SELECT * FROM `user` WHERE `email`='" . $br["user_email"] . "'");
                                $us2 = $userrs2->fetch_assoc();
                                ?>
                                <div class="col-6 col-lg-3 bg-white pt-2 pb-2 d-none d-lg-block border border-start-0 border-top-0 border-end border-bottom-0 border-primary border-2">
                                    <span class="fs-5 fw-bold text-dark"><?php echo $us2["fname"] . " " . $us2["lname"]; ?></span>
                                </div>
                                <div class="col-2 bg-white pt-2 pb-2 d-none d-lg-block border border-start-0 border-top-0 border-end border-bottom-0 border-primary border-2">
                                    <span class="fs-5 fw-bold text-dark">Rs. <?php echo $br["total"]; ?>.00</span>
                                </div>
                                <div class="col-3 col-lg-2 bg-white pt-2 pb-2 ">
                                    <span class="fs-5 fw-bold text-dark"><?php echo $br["qty"]; ?></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
            } else {
                $todayrs = Database::search("SELECT * FROM `invoice`");
                $tn = $todayrs->num_rows;

                for ($z = 0; $z < $tn; $z++) {
                    $tr = $todayrs->fetch_assoc();

                    $nodate = $tr["date"];
                    $splitdate = explode(" ", $nodate);
                    $date = $splitdate[0];

                    $today = date("Y-m-d");

                    if ($today == $date) {
                    ?>
                        <div class="col-12 mb-2">
                            <div class="row">
                                <div class="col-3 col-lg-2 bg-white pt-2 pb-2 text-end border border-start-0 border-top-0 border-end border-bottom-0 border-primary border-2">
                                    <span class="fs-5 fw-bold text-dark"><?php echo $tr["order_id"]; ?></span>
                                </div>
                                <?php
                                $prors3 = Database::search("SELECT * FROM `product` WHERE `id`='" . $tr["product_id"] . "'");
                                $pro3 = $prors3->fetch_assoc();
                                ?>
                                <div class="col-6 col-lg-3 bg-white pt-2 pb-2 border border-start-0 border-top-0 border-end border-bottom-0 border-primary border-2">
                                    <span class="fs-5 fw-bold text-dark"><?php echo $pro3["title"]; ?></span>
                                </div>
                                <?php
                                $userrs3 = Database::search("SELECT * FROM `user` WHERE `email`='" . $tr["user_email"] . "'");
                                $us3 = $userrs3->fetch_assoc();
                                ?>
                                <div class="col-6 col-lg-3 bg-white pt-2 pb-2 d-none d-lg-block border border-start-0 border-top-0 border-end border-bottom-0 border-primary border-2">
                                    <span class="fs-5 fw-bold text-dark"><?php echo $us3["fname"] . " " . $us3["lname"]; ?></span>
                                </div>
                                <div class="col-2 bg-white pt-2 pb-2 d-none d-lg-block border border-start-0 border-top-0 border-end border-bottom-0 border-primary border-2">
                                    <span class="fs-5 fw-bold text-dark">Rs. <?php echo $tr["total"]; ?>.00</span>
                                </div>
                                <div class="col-3 col-lg-2 bg-white pt-2 pb-2 ">
                                    <span class="fs-5 fw-bold text-dark"><?php echo $tr["qty"]; ?></span>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>




            <div style="margin-top: 200px;"></div>

            <?php require "footer.php"; ?>



        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>