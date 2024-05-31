<?php
require "connection.php";
session_start();

if (isset($_SESSION["p"])) {
    $product = $_SESSION["p"];
?>
    <!DOCTYPE html>

    <html>

    <head>
        <title>ZUKI | Update Product</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="resources/zukilogo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">


                    <!-- header -->
                    <div class="col-12 mb-4">
                        <h3 class="h2 text-center text-primary">Product Update</h3>
                    </div>
                    <!-- header -->


                    <!-- category title qty -->
                    <div class="col-lg-12 mb-2">
                        <div class="row">

                            <div class="col-12 col-lg-4 ">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1 fw-bold">Select Food Category</label>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-select" id="ca" disabled>
                                            <?php
                                            $category = Database::search("SELECT * FROM `category` WHERE `id`='" . $product["category_id"] . "'");
                                            $ct = $category->fetch_assoc();
                                            ?>
                                            <option value="<?php echo $ct["id"]; ?>"><?php echo $ct["name"]; ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Add a Title for Food</label>
                                    </div>
                                    <div class=" col-12 ">
                                        <input class="form-control" type="text" id="ti" value="<?php echo $product["title"]; ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Add Quantity</label>
                                        <input class="form-control" type="number" value="<?php echo $product["qty"]; ?>" min="0" id="qty" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- category title qty -->

                    <hr class="hrbreak1" />

                    <!-- cost,payment method -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Cost Per Item</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost" value="<?php echo $product["price"]; ?>" disabled>
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-12 col-lg-11 offset-lg-1">
                                        <label class="form-label lbl1">Approved Payment Methods</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="offset-2 col-2 pm1"></div>
                                            <div class="col-2 pm2"></div>
                                            <div class="col-2 pm3"></div>
                                            <div class="col-2 pm4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- cost,payment method -->

                    <hr class="hrbreak1" />

                    <!-- delivery cost -->
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Delivery Cost</label>
                                </div>
                                <div class="offset-lg-1 col-12 col-lg-3">
                                    <label class="form-label">Delivery Cost Within Dankotuwa</label>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="dwc" value="<?php echo $product["delivery_fee_dankotuwa"]; ?>">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1"></label>
                                </div>
                                <div class="offset-lg-1 col-12 col-lg-3 mt-3">
                                    <label class="form-label">Delivery Cost out of Dankotuwa</label>
                                </div>
                                <div class="col-12 col-lg-7 mt-3">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="doc" value="<?php echo $product["delivery_fee_other"]; ?>">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- delivery cost -->

                    <hr class="hrbreak1" />

                    <!-- description -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1">Product Description</label>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" cols="100" rows="10" style="background-color: honeydew;" id="desc"><?php echo $product["description"]; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- description -->

                    <hr class="hrbreak1" />


                    <!-- save btn  -->
                    <div class="offset-0 offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                        <button class="btn btn-success searchbtn" onclick="updateProduct();">Update</button>
                    </div>
                    <!-- save btn  -->


                    <!-- footer -->
                    <?php
                    require "footer.php";
                    ?>
                    <!-- footer -->
               







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