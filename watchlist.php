<?php
require "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $uemail = $_SESSION["u"]["email"];

?>
    <!DOCTYPE html>

    <html>

    <head>
        <title>ZUKI | watchlist</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="resources/zukilogo.svg" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <?php
                require "header.php";
                ?>

                <div class="col-12 border border-1 border-secondary rounded">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-2 text-danger fw-bolder">watchlist &hearts;</label>
                        </div>
                        <div class="col-12">
                            <div class="hrbreak2"></div>
                        </div>
                        <!-- <div class="col-12">
                            <div class="row">
                                <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-2">
                                    <input type="text" class="form-control" placeholder="Search in watchlist..." />
                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-2">
                                    <button class="btn btn-outline-primary">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr class="hrbreak1">
                        </div> -->
                        <div class="col-12 col-lg-2 border border-start-0 border-top-0 border-bottom-0 border-end border-2 border-primary">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                </ol>
                            </nav>
                            <nav class="nav nav-pills flex-column">
                                <a class="nav-link active" aria-current="page" href="#">My Watchlist</a>
                                <a class="nav-link" href="cart.php">My Cart</a>
                            </nav>
                        </div>

                        <?php
                        $watchlistr = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $uemail . "'");
                        $wn = $watchlistr->num_rows;

                        if ($wn == 0) {
                        ?>
                            <!-- empty watchlist -->
                            <div class="col-12 col-lg-9">
                                <div class="row">
                                    <div class="col-12 emptyview"></div>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-2 mb-3 fw-bolder">You have no items in your watchlist</label>
                                    </div>
                                </div>
                            </div>
                            <!-- empty watchlist -->
                        <?php
                        } else {
                        ?>
                            <div class="col-12 col-lg-9">
                                <div class="row g-2">
                                    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
                                        <?php
                                        for ($i = 0; $i < $wn; $i++) {
                                            $wr = $watchlistr->fetch_assoc();
                                            $wid = $wr["product_id"];

                                            $wproduct = Database::search("SELECT * FROM `Product` WHERE `id`='" . $wid . "'");
                                            $wp = $wproduct->num_rows;
                                            for ($X = 0; $X < $wp; $X++) {
                                                $wpro = $wproduct->fetch_assoc();
                                                $status = $wpro["status_id"];
                                                if ($status == 1) {
                                        ?>
                                                    <div class="col">
                                                        <div class="card h-100 border border-danger">
                                                            <div class="card-body">
                                                                <h4 class="card-title text-success fw-bold"><?php echo $wpro["title"]; ?></h4>
                                                                <span class="card-text text-primary">RS.<?php echo $wpro["price"]; ?>.00</span>
                                                                <br />
                                                                <?php
                                                                if ((int)$wpro["qty"] > 0) {
                                                                ?>
                                                                    <span class="card-text text-warning">Available Packs :</span>
                                                                    <input class="form-control mb-2" type="number" value="<?php echo $wpro["qty"]; ?>" id="qtytxt<?php echo $wpro["id"]; ?>" />
                                                            </div>
                                                            <div class="card-footer">
                                                                <a href='<?php echo "singleProductView.php?id=" . ($wpro["id"]); ?>' class="btn btn-outline-success col-12  mt-1">Buy Now & More</a>
                                                                <a class="btn btn-outline-secondary col-12 mt-1" onclick='addToCart(<?php echo $wpro["id"]; ?>);'>Add To Cart</a>
                                                                <a class="btn btn-outline-danger col-12 mt-1 mb-1" onclick='deletefromwatchlist(<?php echo $wr["id"]; ?>);'>Remove</a>
                                                            </div>
                                                        <?php
                                                                } else {
                                                        ?>
                                                            <span class="card-text text-warning">Unavailable Now</span>
                                                        </div>
                                                        <div class="card-footer">
                                                            <a href="#" class="btn btn-success col-12 mb-1" disabled>Buy Now</a>
                                                            <a href="#" class="btn btn-danger col-12" disabled>Add To Cart</a>
                                                            <a href="#" class="btn btn-outline-danger col-12 mt-1 mb-1" onclick='deletefromwatchlist(<?php echo $wr["id"]; ?>);'>Remove</a>
                                                        </div>
                                                    <?php
                                                                }
                                                    ?>
                                                    </div>
                                    </div>
                        <?php
                                                }
                                            }
                                        }
                        ?>
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
    </body>

    </html>

<?php
}
?>