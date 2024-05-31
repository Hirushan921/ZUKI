<?php
session_start();
require "connection.php";

$id = $_GET["id"];

?>

<!DOCTYPE html>

<html>

<head>
    <title>ZUKI | Full Menu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/zukilogo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="homebody">
    <div class="container-fluid">
        <div class="row">

            <!-- header -->
            <?php
            require "header.php";
            ?>
            <!-- header -->

            <div class="col-12 footerclr text-center">
                <?php
                $cat = Database::search("SELECT * FROM `category` WHERE `id`='" . $id . "'");
                $c = $cat->fetch_assoc();
                ?>
                <label class="form-label fs-1 text-white  mt-2"><?php echo $c["name"]; ?></label><br />
                <label class="form-label fs-4 text-white fmenu mt-1">DINNER MENU OF ZUKI</label>
            </div>

            <div class="row mt-4 mb-5">
                <div class="col-12 ">
                    <div class="row ms-2 border border-danger px-5">

                        <div class="row row-cols-1 row-cols-md-5 g-4 mb-4">
                            <?php
                            $product = Database::search("SELECT * FROM `Product` WHERE `category_id`='" . $id . "'");
                            $p = $product->num_rows;
                            if ($p >= 1) {
                                for ($X = 0; $X < $p; $X++) {
                                    $pro = $product->fetch_assoc();
                                    $status = $pro["status_id"];
                                    if ($status == 1) {
                            ?>
                                        <div class="col">
                                            <div class="card h-100 border border-danger">
                                                <div class="card-body">
                                                    <h4 class="card-title text-success fw-bold"><?php echo $pro["title"]; ?></h4>
                                                    <span class="card-text text-primary">RS.<?php echo $pro["price"]; ?>.00</span>
                                                    <br />
                                                    <?php
                                                    if ((int)$pro["qty"] > 0) {
                                                    ?>
                                                        <span class="card-text text-warning">Available Packs :</span>
                                                        <input class="form-control mb-2" type="number" value="<?php echo $pro["qty"]; ?>" id="qtytxt<?php echo $pro["id"]; ?>" />
                                                </div>
                                                <div class="card-footer">
                                                    <a class="btn btn-danger col-8 " onclick='addToCart(<?php echo $pro["id"]; ?>);'>Add To Cart</a>
                                                    <a href="#" class="btn btn-secondary col-3 ms-2 mt-1 mb-1" onclick='addToWatchlist(<?php echo $pro["id"]; ?>);'><i class="bi bi-heart-fill"></i></a>
                                                    <a href='<?php echo "singleProductView.php?id=" . ($pro["id"]); ?>' class="btn btn-success col-12  mt-1">Buy Now & More</a>
                                                </div>
                                            <?php
                                                    } else {
                                            ?>
                                                <span class="card-text text-warning">Unavailable Now</span>
                                            </div>
                                            <div class="card-footer">
                                                <a href="#" class="btn btn-success col-12 mb-1" disabled>Buy Now</a>
                                                <a href="#" class="btn btn-danger col-12" disabled>Add To Cart</a>
                                            </div>
                                        <?php
                                                    }
                                        ?>
                                        </div>
                        </div>
                <?php
                                    }
                                }
                            } else {
                ?>
                <h3>This Foods Unavailable Now..
                Please Select another Food Category..</h3>
            <?php
                            }
            ?>
                    </div>

                </div>
            </div>
        </div>







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