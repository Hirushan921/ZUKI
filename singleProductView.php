<?php

session_start();
require "connection.php";
$umail = $_SESSION["u"]["email"];

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
    $pn = $productrs->num_rows;

    if ($pn == 1) {

        $pd = $productrs->fetch_assoc();

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>ZUKI | Buy Food</title>
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="style.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
            <link rel="icon" href="resources/zukilogo.svg" />
        </head>

        <body>

            <div class="container-fluid">
                <div class="row">

                    <?php
                    require "header.php";
                    ?>

                    <div class="col-12 bg-light">
                        <label class="form-label fs-2 text-danger fw-bolder">Get Your Order Now..</label>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="hrbreak2"></div>
                    </div>

                    <div class="col-12 col-lg-4  border border-start-0 border-top-0 border-bottom-0 border-end border-2 border-danger">
                        <div class="row">

                            <div class="col-12">
                                <lable class="form-lable fs-4 fw-bold mt-0"><?php echo $pd["title"]; ?></lable>
                            </div>

                            <div class="col-12 mt-1">
                                <span class="badge badge-success">
                                    <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                    <lable class="text-dark fs-6">4.5 star</lable>
                                    <lable class="text-dark fs-6">35 | 35 Rating & Reviews</lable>
                                </span>
                            </div>

                            <?php
                            $catid = $pd["category_id"];
                            $imagesrs = Database::search("SELECT * FROM `category` WHERE `id`='" . $catid . "'");
                            $d = $imagesrs->fetch_assoc();
                            ?>
                            <div class="col-12">
                                <div class="align-items-center  p-3">
                                    <div style="background-image: url('<?php echo $d["code"] ?>');background-repeat: no-repeat;background-size: contain;height: 370px;" id="mainimg"></div>
                                </div>
                            </div>


                        </div>
                    </div>



                    <div class="col-12 col-lg-4 border border-start-0 border-top-0 border-bottom-0 border-end border-2 border-danger">
                        <div class="row">

                            <div class="col-12 d-inline-block">
                                <label class="fw-bold mt-1 fs-4">Rs. <?php echo $pd["price"]; ?>.00</label>
                                <?php $a = $pd["price"];
                                $newval = $a + 50; ?>
                                <label class="fw-bold mt-1 fs-6 text-danger"><del>Rs. <?php echo $newval ?>.00</del></label>
                            </div>

                            <div class="col-12 mt-2">
                                <lable class="text-primary fs-6"><b>More Details:</b></lable><br />
                                <p class="text-primary fs-6"><?php echo $pd["description"]; ?></p>
                                <lable class="text-primary fs-6"><b><?php echo $pd["qty"]; ?> Packs</b> Available Now. </lable>
                            </div>

                            <div class="col-11 ms-3 mt-2 offset-1 rounded border border-1 border-success mt-2">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-lg-1">
                                        <img src="resources/pricetag.png" />
                                    </div>
                                    <div class="col-md-9 col-sm-9 mt-1 pe-4 col-lg-10 offset-lg-1">
                                        <label class="text-black-50">Get a free pack over 5000 rupees</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-11 ms-3" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="border border-1 border-secondary rounded overflow-hidden float-start product_qty d-inline-block position-relative">
                                        <span class="mt-2">Add Qty :</span>
                                        <input id="qtyinput" class="border-0 fs-6 fw-bold text-start mt-2" type="text" pattern="[0-9]*" value="1" readonly />
                                        <div class="position-absolute qty-buttons">
                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-inc">
                                                <i class="fas fa-chevron-up" onclick="qty_inc(<?php echo $pd['qty']; ?>);"></i>
                                            </div>
                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-dec">
                                                <i class="fas fa-chevron-down" onclick="qty_dec();"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" col-12 mt-2 ">
                                <div class="row">
                                    <div class="col-6  d-grid ">
                                        <button class="btn btn-secondary" onclick="addToCart2(<?php echo $pid; ?>)">Add to cart</button>
                                    </div>
                                    <div class="col-6 d-grid">
                                        <button class="btn btn-secondary" onclick="addToWatchlist(<?php echo $pid; ?>)">Add to Watchlist</button>
                                    </div>
                                    <div class="col-12 mt-3 d-grid">
                                        <button class="btn btn-success" id="payhere-payment" type="submit" onclick="paynow(<?php echo $pid; ?>);">Buy Now</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                        <div class="row">

                            <div class="col-12 ">
                                <?php
                                $iaddressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                                $iar = $iaddressrs->fetch_assoc();
                                ?>
                                <lable class="text-dark fs-5"><b>Your Delivery Address:</b></lable><br />
                                <span class="text-primary fs-6"><?php echo $iar["line1"]; ?>,</span><br />
                                <span class="text-primary fs-6"><?php echo $iar["line2"]; ?>,</span><br />
                                <span class="text-primary fs-6"><?php echo $iar["city"]; ?></span><br /><br />
                                <span class="text-dark fs-6">If this address isn't your delivery address..You can go to profile and update your address..</span>
                            </div>

                            <div class="col-12 mt-2">
                                <a href="userprofile.php" class="btn btn-dark">Go To Profile</a>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="row">
                                    <span class="text-danger fs-7"><b>Notice: </b>No Delivery Outside the Puttalam District & You can come to the restaurant and get your order</span><br />
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 mt-2 mb-2">
                        <div class="hrbreak2"></div>
                    </div>

                    <div class="col-12 bg-white">
                        <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                            <div class="col-md-6">
                                <span class="fs-3 fw-bold">Feedbacks...</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="row g-1">
                            <?php
                            $feedbackrs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                            $feed = $feedbackrs->num_rows;
                            if ($feed == 0) {
                            ?>
                                <div class="col-12">
                                    <label class="form-label fs-3 text-center text-black-50">There ara no feedbacks to view</label>
                                </div>
                                <?php
                            } else {
                                for ($a = 0; $a < $feed; $a++) {
                                    $feedrow = $feedbackrs->fetch_assoc();
                                    $feedmail = $feedrow["user_email"];
                                ?>
                                    <div class="col-12 col-lg-4 border border-1 border-danger rounded">
                                        <div class="row">
                                            <?php
                                            $feeduser = Database::search("SELECT * FROM `user` WHERE `email`='" . $feedmail . "'");
                                            $fu = $feeduser->fetch_assoc();
                                            ?>
                                            <div class="col-12">
                                                <span class="fs-6 fw-bold text-dark"><?php echo $fu["fname"] . " " . $fu["lname"]; ?></span>
                                            </div>
                                            <div class="col-12">
                                                <span class="fs-6 fw-bold text-primary"><?php echo $feedrow["feed"]; ?></span>
                                            </div>
                                            <div class="col-12 text-end">
                                                <span class="fs-7 fw-bold text-black-50"><?php echo $feedrow["date"]; ?></span>
                                            </div>
                                        </div>
                                    </div>

                            <?php
                                }
                            }
                            ?>

                        </div>
                    </div>





                </div>
            </div>


            <script src="script.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="bootstrap.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>
<?php

    }
}

?>