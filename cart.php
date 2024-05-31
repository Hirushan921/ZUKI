<?php
require "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $umail = $_SESSION["u"]["email"];

    $total = "0";
    $subtotal = "0";
    $shipping = "0";

?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>ZUKI | Basket</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="resources/zukilogo.svg" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">


                <?php
                require "header.php";
                ?>

                <!-- <div class="col-12" style="background-color: #E3E4E5;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Basket</li>
                        </ol>
                    </nav>
                </div> -->

                <div class="col-12 border border-1 border-secondary rounded mb-3">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-2 text-danger fw-bolder">Food Basket <i class="bi bi-basket"></i></label>
                        </div>
                        <!-- <div class="col-12 col-lg-6">
                            <hr class="hrbreak1">
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-2">
                                    <input type="text" class="form-control" placeholder="Search in basket..." />
                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-2">
                                    <button class="btn btn-outline-danger">Search</button>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-12 mb-2">
                            <div class="hrbreak2"></div>
                        </div>

                        <?php
                        $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $umail . "'");
                        $cn = $cartrs->num_rows;

                        if ($cn == 0) {
                        ?>
                            <!-- empty cart  -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptycart"></div>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-2 fw-bolder">You have no items in your basket.</label>
                                    </div>
                                    <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-4">
                                        <a href="#" class="btn btn-primary fs-3">Start Shopping</a>
                                    </div>
                                </div>
                            </div>
                            <!-- empty cart  -->
                        <?php
                        } else {
                        ?>
                            <div class="col-lg-6 col-12">
                                <div class="row">

                                    <?php
                                    for ($i = 0; $i < $cn; $i++) {
                                        $cr = $cartrs->fetch_assoc();

                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cr["product_id"] . "'");
                                        $pr = $productrs->fetch_assoc();

                                        $total = $total + ($pr["price"] * $cr["qty"]);

                                        $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                                        $ar = $addressrs->fetch_assoc();
                                        $cityid = $ar["city"];
                                        $districtid = $ar["district_id"];

                                        $ship = 0;
                                        if ($cityid == "Dankotuwa" || $cityid == "dankotuwa") {
                                            $ship = $pr["delivery_fee_dankotuwa"];
                                            // $shipping = $shipping + $pr["delivery_fee_dankotuwa"];
                                            $shipping =  $pr["delivery_fee_dankotuwa"];
                                        } elseif ($districtid != "1") {
                                            $ship = 0;
                                            // $shipping = $shipping + 0;
                                            $shipping =   0;
                                        } else {
                                            $ship = $pr["delivery_fee_other"];
                                            // $shipping = $shipping + $pr["delivery_fee_other"];
                                            $shipping = $pr["delivery_fee_other"];
                                        }


                                        if($pr["status_id"]==1 && $pr["qty"]>=$cr["qty"]){
     
                                    ?>

                                   <div class="card mb-3 ms-lg-5 mx-3 mx-lg-0 col-11 col-lg-12 border-danger border-2">
                                            <div class="row g-0">

                                                <div class="col-6 col-md-6 ">
                                                    <div class="card-body ">
                                                        <h5 class="card-title fw-bold text-black" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $pr["description"]; ?>" style="cursor: pointer;"><?php echo $pr["title"]; ?></h5>

                                                        <span class="fw-bold text-black-50 fs-6">Price</span>&nbsp;
                                                        <span class="fw-bolder text-black fs-6">Rs. <?php echo $pr["price"]; ?>.00</span>
                                                        <br />
                                                        <span class="fw-bold text-black-50 fs-6">Quantity</span>&nbsp;
                                                        <input type="text" value="<?php echo $cr["qty"]; ?>" class="mt-2 mb-2 border border-2 border-secondary fs-6 fw-bold px-3 cartqtytxt" readonly />
                                                        <br />
                                                        <span class="fw-bold text-black-50 fs-6">Delivery Fee</span>&nbsp;
                                                        <span class="fw-bolder text-black fs-6">Rs. <?php echo $ship; ?>.00</span>
                                                        <?php
                                                        if ($districtid != "1") {
                                                        ?>
                                                            || <span class="fw-bolder text-black fs-6">No Delivery Out of Puttalam District.</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-5 mt-2 mb-3 border border-start border-top-0 border-bottom-0 border-end-0 border-1 border-danger">
                                                    <div class="row">
                                                        <div class="offset-1 col-11">
                                                            <span class="fw-bold fs-5 text-dark">Sub Total <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="offset-1 col-11">
                                                            <span class="fw-bold fs-6 text-success">Rs. <?php echo $pr["price"] * $cr["qty"] + $ship; ?>.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-1 col-md-1">
                                                    <!-- <div class="card-body d-grid"> -->
                                                        <div class="text-end fs-4" style="cursor: pointer;" onclick='deletefromcart(<?php echo $cr["id"]; ?>);'><i class="bi bi-x-circle"></i></div>
                                                    <!-- </div> -->
                                                </div>
                                                
                                            </div>
                                        </div>


                                    <?php
                                    }
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="col-12 col-lg-5 offset-lg-1 border border-end-0 border-top-0 border-bottom-0 border-start border-2 border-primary">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label fs-4 fw-bold">Summarized Price</label>
                                    </div>
                                    <div class="col-12">
                                        <hr />
                                    </div>
                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Food Items (<?php echo $cn; ?>)</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $total; ?>.00</span>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <span class="fs-6 fw-bold">Delivery Charge</span>
                                    </div>
                                    <div class="col-6 text-end mt-2">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?>.00</span>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>
                                    <div class="col-6 mt-3">
                                        <span class="fs-5 fw-bold">Total Price</span>
                                    </div>
                                    <div class="col-6 text-end mt-3">
                                        <span class="fs-5 fw-bold">Rs. <?php echo $total + $shipping; ?>.00</span>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <hr />
                                        <hr />
                                    </div>
                                    <div class="col-12 mt-1 mb-3 d-grid">
                                        <?php
                                        $fullamount = ($total + $shipping);
                                        ?>
                                        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
                                        <button class="btn btn-success fs-5 fw-bold" id="payhere-payment" type="submit" onclick="checkout('<?php echo $fullamount ?>');">ALL BUY</button>
                                    </div>
                                </div>
                            </div>


                        <?php
                        }
                        ?>




                    </div>
                </div>







                <?php
                require "footer.php";
                ?>

            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>


    </body>

    </html>

<?php
}
?>