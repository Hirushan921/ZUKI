<?php
require "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $mail = $_SESSION["u"]["email"];

    $invoicers = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $mail . "'");
    $in = $invoicers->num_rows;

?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>ZUKI | Transaction History</title>
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

                <?php require "header.php" ?>


                <div class="col-12 text-center mb-1">
                    <span class="fs-1 fw-bold text-danger">Purchase History</span>
                </div>
                <div class="hrbreak2"></div>

                <?php
                if ($in == 0) {
                ?>
                    <!-- no items  -->
                    <div class="col-12 text-center bg-light" style="height: 450px;">
                        <span class="fs-1 fw-bold text-black-50 d-block" style="margin-top: 200px;">You have no items in your transaction history...</span>
                    </div>
                    <!-- no items  -->
                <?php
                } else {
                ?>

                    <div class="col-12 mt-2">
                        <div class="row">

                            <div class="col-12 d-none d-lg-block">
                                <div class="row">
                                    <div class="col-2 bg-success py-3 ">
                                        <label class="form-label text-white fw-bold">Order ID</label>
                                    </div>
                                    <div class="col-3 bg-success py-3  ">
                                        <label class="form-label text-white fw-bold">Food Item</label>
                                    </div>
                                    <div class="col-1 bg-success py-3 text-end">
                                        <label class="form-label text-white fw-bold">Quantity</label>
                                    </div>
                                    <div class="col-2 bg-success text-center">
                                        <label class="form-label text-white fw-bold">Total Price</label><br />
                                        <label class="form-label text-white fw-bold">(with delivery fee)</label>
                                    </div>
                                    <div class="col-2 bg-success py-3 text-white text-end">
                                        <label class="form-label text-white fw-bold">Purchased Data & Time</label>
                                    </div>
                                    <div class="col-2 bg-success"></div>
                                    <div class="col-12">
                                        <hr />
                                    </div>
                                </div>
                            </div>

                            <?php
                            for ($i = 0; $i < $in; $i++) {
                                $ir = $invoicers->fetch_assoc();

                                if ($ir["status_id"] == 1) {
                            ?>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12 col-lg-2 text-lg-start text-center">
                                                <label class="form-label fs-5  text-center"><?php echo $ir["order_id"]; ?></label>
                                            </div>

                                            <div class="col-11 col-lg-3 text-lg-start text-center">
                                                <?php
                                                $pid = $ir["product_id"];
                                                $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
                                                $pr = $productrs->fetch_assoc();
                                                ?>
                                                <label class="form-label fs-5 text-dark fw-bold"><?php echo $pr["title"]; ?></label>
                                            </div>

                                            <div class="col-12 col-lg-1 text-center text-lg-end">
                                                <label class="form-label fs-5 "><?php echo $ir["qty"]; ?></label>
                                            </div>

                                            <div class="col-12 col-lg-2 text-center text-lg-end ">
                                                <label class="form-label fs-5 ">Rs. <?php echo $ir["total"]; ?>.00</label>
                                            </div>

                                            <div class="col-12 col-lg-2 text-center text-lg-end">
                                                <label class="form-label fs-5 "><?php echo $ir["date"]; ?></label>
                                            </div>

                                            <div class="col-12 col-lg-2">
                                                <div class="row">
                                                    <div class="col-8 offset-2 d-grid">
                                                        <button class="btn btn-sm btn-secondary " onclick="addFeedback(<?php echo $pid ?>);"><i class="bi bi-info-circle-fill"></i> Feedback</button>
                                                    </div>
                                                    <div class="col-8 offset-2 mt-2 d-grid">
                                                        <button class="btn btn-sm btn-dark rounded " onclick="deletePHistory('<?php echo $ir['order_id'] ?>');"><i class="bi bi-trash-fill"></i> Delete</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                            <hr style="height:5px;  color: maroon; ">
                                            </div>

                                            <!-- feed modal -->
                                            <div class="modal fade" id="feedbackModal<?php echo $pid; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $pr["title"]; ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <textarea id="feedtxt<?php echo $pid; ?>" cols="30" rows="10" class="form-control fs-5"></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-primary" onclick="saveFeedback(<?php echo $pid; ?>);">Save Feedback</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- feed modal -->

                                        </div>
                                    </div>

                            <?php
                                }
                            }
                            ?>


                        </div>
                    </div>


                    <div class="col-12">
                        <hr />
                    </div>

                    <div class="col-12 mb-3">
                        <div class="row">
                            <div class="col-lg-10 d-none d-lg-block"></div>
                            <div class="col-12 col-lg-2 d-grid">
                                <button class="btn btn-danger fs-5" onclick="delAllHistory();"><i class="bi bi-trash-fill"></i> Clear All History</button>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>



                <?php require "footer.php" ?>

            </div>
        </div>


        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>

<?php
}
?>