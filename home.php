<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>

<html>

<head>
    <title>ZUKI Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/zukilogo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
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



            <!-- logo and search bar  -->
            <div class="col-12 justify-content-center " >
                <div class="row mb-2 mt-1">
                    <div class="col-12 offset-lg-1 col-lg-2 logoimg" style="background-position: center;"></div>
                    <div class="col-12  offset-lg-0 col-lg-6">
                        <div class="input-group ms-1 mt-4 mb-3">
                            <select class="btn btn-outline-danger col-lg-3 col-6" id="basic_search_select">
                                <option value="0">Category</option>
                                <?php
                                $rs = Database::search("SELECT * FROM `category`");
                                $n = $rs->num_rows;
                                for ($i = 0; $i < $n; $i++) {
                                    $cat = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $cat["id"]; ?>"><?php echo $cat["name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt">
                            <button class="btn btn-outline-danger" onclick="basicSearch(1);"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-2 col-11 offset-1 offset-lg-0 d-grid gap-2 text-align-center">
                        <div class="row">
                            <div class="col-2 mt-4 ms-5 ms-lg-3 wishicon" style="cursor: pointer;" onclick="goToWishlist();"></div>
                            <div class="col-2 mt-4 ms-5 ms-lg-3 carticon" style="cursor: pointer;" onclick="goToCart();"></div>
                            <div class="col-2 mt-4 ms-5 ms-lg-3 profileicon" style="cursor: pointer;" onclick="goToprofile();"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- logo and search bar  -->

            <div class="hrbreak2"></div>

            <!-- img slide -->
            <div class="col-12 d-none mt-1 d-lg-block" id="imgslide">
                <div class="row">
                    <div id="carouselExampleCaptions" class="carousel slide offset-2 col-8" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="resources/food wallpaper.jpg" class="d-block posterimg1" alt="...">
                                <div class="carousel-caption d-none d-md-block postercaption">
                                    <h5 class="postertitle">Welcome to ZUKI</h5>
                                    <p class="postertxt">The Best Night restaurant for you..</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="resources/kottu-roti.jpg" class="d-block posterimg1" alt="...">
                                <div class="carousel-caption d-none d-md-block postercaption">
                                    <p class="postertitle">Different types of delicious foods...</p>
                                    <p class="postertxt">Plan your favourite dinner with us..</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="resources/fastdelivery.jpg" class="d-block posterimg1" alt="...">
                                <!-- <div class="carousel-caption d-none d-md-block postercaption1">
                                    <h5 class="postertitle">Be free.....</h5>
                                    <p class="postertxt">Experience the Lowest Delivery Costs With Us.</p>
                                </div> -->
                            </div>
                            <div class="carousel-item">
                                <img src="resources/safedelivery.png" class="d-block posterimg1" alt="...">
                                <!-- <div class="carousel-caption d-none d-md-block postercaption1">
                                    <h5 class="postertitle">Be free.....</h5>
                                    <p class="postertxt">Experience the Lowest Delivery Costs With Us.</p>
                                </div> -->
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- img slide -->

            <div class="col-12" id="sdetails">

            </div>

            <div class="col-12 mt-2">
                <div class="hrbreak2"></div>
                <h1 class="text-danger hometitle1 text-center mt-1">Today Specials</h1>
                <div class="hrbreak2 mb-3"></div>
            </div>

            <?php
            $resultset = Database::search("SELECT * FROM `product` ORDER BY `datetime_added` DESC LIMIT 5 OFFSET 0");
            $nr = $resultset->num_rows;
            ?>

            <div class="row  mb-5">
                <div class="col-12">
                    <div class="row ms-2 border border-dark ps-lg-5">
                        <div class="row row-cols-1 row-cols-md-5 g-4 mb-4">
                            <?php
                            for ($y = 0; $y < $nr; $y++) {
                                $prod = $resultset->fetch_assoc();
                                $status1 = $prod["status_id"];
                                if ($status1 == 1) {
                            ?>
                                    <div class="col">
                                        <div class="card h-100 border border-danger">
                                            <div class="card-body">
                                                <h4 class="card-title text-success fw-bold"><?php echo $prod["title"]; ?></h4>
                                                <span class="card-text text-primary">RS.<?php echo $prod["price"]; ?>.00</span>
                                                <br />
                                                <?php
                                                if ((int)$prod["qty"] > 0) {
                                                ?>
                                                    <span class="card-text text-warning">Available Packs :</span>
                                                    <input class="form-control mb-2" type="number" value="<?php echo $prod["qty"]; ?>" id="qtytxt<?php echo $prod["id"]; ?>" />
                                            </div>
                                            <div class="card-footer">
                                                <a class="btn btn-danger col-8 " onclick='addToCart(<?php echo $prod["id"]; ?>);'>Add To Cart</a>
                                                <a href="#" class="btn btn-secondary col-3 ms-2 mt-1 mb-1" onclick='addToWatchlist(<?php echo $prod["id"]; ?>);'><i class="bi bi-heart-fill"></i></a>
                                                <a href='<?php echo "singleProductView.php?id=" . ($prod["id"]); ?>' class="btn btn-success col-12  mt-1">Buy Now & More</a>
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
                ?>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="col-12 mt-2">
                <div class="hrbreak2"></div>
                <h1 class="text-danger hometitle1 text-center mt-1">MENU</h1>
                <div class="hrbreak2 mb-3"></div>
            </div>

        <div class="row  mb-5">
            <div class="col-12 ">
                <div class="row ms-2 border border-dark px-5">

                    <div class="row row-cols-1 row-cols-md-4 g-4 mb-4">
                        <?php
                        $cat = Database::search("SELECT * FROM `category`");
                        $n = $cat->num_rows;
                        for ($X = 0; $X < $n; $X++) {
                            $c = $cat->fetch_assoc();
                            $s = $c["status_id"];
                            if ($s == 1) {
                        ?>
                                <div class="col" onclick='gotofullmenu(<?php echo $c["id"]; ?>);'>
                                    <div class="card h-100 border border-danger">
                                        <img src="<?php echo $c["code"]; ?>" class="card-img-top cardtopimg" alt="...">
                                        <div class="card-body">
                                            <h4 class="card-title text-success fw-bold"><?php echo $c["name"]; ?></h4>
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