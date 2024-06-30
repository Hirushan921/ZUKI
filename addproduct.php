<?php
require "connection.php";
?>

<!DOCTYPE html>

<html>

<head>
    <title>ZUKI - Admin - Add Product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/zukilogo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="container-fluid">
        <div class="row gy-3">

            <?php
            require "adminheader.php";
            ?>


            <!-- header -->
            <div class="col-12 bg-white">
                <h3 class="h2 text-center text-danger fw-bold">Add Food Item</h3>
            </div>
            <!-- header -->
            <div class="hrbreak2 mb-3"></div>

            <!-- category title qty -->
            <div class="col-lg-12">
                <div class="row">

                    <div class="col-12 col-lg-4">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1">Select Food Category</label>
                            </div>
                            <div class="col-12">
                                <select class="form-select" id="ca">
                                    <option value="0">Select Category</option>
                                    <?php
                                    $cat = Database::search("SELECT * FROM `category`");
                                    $n = $cat->num_rows;
                                    for ($X = 0; $X < $n; $X++) {
                                        $c = $cat->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $c["id"]; ?>"><?php echo $c["name"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1">Add a Title for Food</label>
                            </div>
                            <div class="col-12 ">
                                <input class="form-control" type="text" id="ti" />
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Add Quantity</label>
                                        <input class="form-control" type="number" value="0" min="0" id="qty" />
                                    </div>
                                </div>
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
                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost">
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
                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="dwc">
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
                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="doc">
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
                        <textarea class="form-control" cols="100" rows="10" style="background-color: honeydew;" id="desc"></textarea>
                    </div>
                </div>
            </div>
            <!-- description -->

            <hr class="hrbreak1" />


            <!-- save btn  -->
            <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid">
                <button class="btn btn-success searchbtn" onclick="addProduct();">Save</button>
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