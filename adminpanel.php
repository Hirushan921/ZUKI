<?php
session_start();
require "connection.php";

if (!isset($_SESSION["a"])) {



?>


    <!DOCTYPE html>
 
    <html>

    <head>
        <title>ZUKI | Admin Panel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="resources/zukilogo.svg" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <script src="script.js"></script>
    </head>


    <body class="adminbody">

        <div class="container-fluid">
            <div class="row">

                <?php
                require "adminheader.php";
                ?>
                <div class="hrbreak2"></div>

                <div class="col-12 bg-light py-3">
                    <div class="row">
                        <h5 class="text-dark py-3 col-12 col-lg-3"><b>Admin</b> : admin name</h5>
                        <a class="offset-lg-4 btn btn-sm btn-primary col-10 offset-1 col-lg-1 mt-2 mt-lg-0 text-center fs-6" href="myproducts.php">Manage Foods</a>
                        <a class="btn btn-sm ms-lg-3 btn-success col-10 offset-1 offset-lg-0  col-lg-1 mt-2 mt-lg-0 text-center fs-6" href="addproduct.php">Add Food Items</a>
                        <a class="btn btn-sm ms-lg-3 btn-secondary col-10 offset-1 offset-lg-0 col-lg-1 mt-2 mt-lg-0 text-center fs-6" href="addcategory.php">Manage Category</a>
                        <a class="btn btn-sm ms-lg-3 btn-dark col-10 offset-1 offset-lg-0 col-lg-1 mt-2 mt-lg-0 text-center fs-6" href="manageusers.php">Manage Users</a>
                    </div>
                </div>


                <div class="hrbreak2"></div>


                <div class="col-12 col-lg-4">
                    <div class="row">
                        <div class="align-items-start bg-dark col-12 text-center">
                            <div class="row g-1">
                                <div class="col-12 mt-5">
                                    <h5 class="text-white">Summery Report</h5>
                                    <hr class="border border-1 border-white" />
                                </div>
                                <div class="col-12 mb-5 sumdiv">
                                    <div class="row g-1">
                                        <div class="col-10 offset-1 px-1">
                                            <div class="row g-1">
                                                <div class="col-12 bg-white text-dark text-center rounded" style="height: 100px;">
                                                    <br />
                                                    <span class="fs-4 text-info fw-bold">Daily Earnings</span>
                                                    <br />
                                                    <?php
                                                    $today = date("Y-m-d");
                                                    $thismonth = date("m");
                                                    $thisyear = date("Y");

                                                    $a = "0";
                                                    $b = "0";
                                                    $c = "0";
                                                    $e = "0";
                                                    $f = "0";

                                                    $invoicers = Database::search("SELECT * FROM `invoice`");
                                                    $in = $invoicers->num_rows;

                                                    for ($x = 0; $x < $in; $x++) {
                                                        $ir = $invoicers->fetch_assoc();

                                                        $f = $f + $ir["qty"];

                                                        $d = $ir["date"];
                                                        $splitdate = explode(" ", $d);
                                                        $pdate = $splitdate[0];

                                                        if ($pdate == $today) {
                                                            $a = $a + $ir["total"];
                                                            $c = $c + $ir["qty"];
                                                        }

                                                        $splitmonth = explode("-", $pdate);
                                                        $pyear = $splitmonth[0];
                                                        $pmonth = $splitmonth[1];

                                                        if ($pyear == $thisyear) {
                                                            if ($pmonth == $thismonth) {
                                                                $b = $b + $ir["total"];
                                                                $e = $e + $ir["qty"];
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <span class="fs-5">Rs. <?php echo $a; ?>.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-10 offset-1 px-1">
                                            <div class="row g-1">
                                                <div class="col-12 bg-white text-dark text-center rounded" style="height: 100px;">
                                                    <br />
                                                    <span class="fs-4 text-success fw-bold">Monthly Earnings</span>
                                                    <br />
                                                    <span class="fs-5">Rs. <?php echo $b; ?>.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-10 offset-1 px-1">
                                            <div class="row g-1">
                                                <div class="col-12 bg-white text-dark text-center rounded" style="height: 100px;">
                                                    <br />
                                                    <span class="fs-4 text-danger fw-bold">Today Selling</span>
                                                    <br />
                                                    <span class="fs-5"><?php echo $c; ?> Items</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-10 offset-1 px-1">
                                            <div class="row g-1">
                                                <div class="col-12 bg-white text-dark text-center rounded" style="height: 100px;">
                                                    <br />
                                                    <span class="fs-4 text-warning fw-bold">Monthly Selling</span>
                                                    <br />
                                                    <span class="fs-5"><?php echo $e; ?> Items</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-10 offset-1 px-1">
                                            <div class="row g-1">
                                                <div class="col-12 bg-white text-dark text-center rounded" style="height: 100px;">
                                                    <br />
                                                    <span class="fs-4 text-primary fw-bold">Total Selling</span>
                                                    <br />
                                                    <span class="fs-5"><?php echo $f; ?> Items</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-10 offset-1 px-1">
                                            <div class="row g-1">
                                                <div class="col-12 bg-white text-dark text-center rounded" style="height: 100px;">
                                                    <br />
                                                    <span class="fs-4 text-secondary fw-bold">Total Engagements</span>
                                                    <br />
                                                    <?php
                                                    $usersrs = Database::search("SELECT * FROM `user`");
                                                    $un = $usersrs->num_rows;
                                                    ?>
                                                    <span class="fs-5"><?php echo $un; ?> Members</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="row">

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-3 text-start mt-3 mb-3">
                                    <label class="form-label fs-5 fw-bold text-dark">Total Active Time</label>
                                </div>
                                <?php
                                $startdate = new DateTime("2021-10-27 00:00:00");

                                $tdate = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $tdate->setTimezone($tz);
                                $endDate = new DateTime($tdate->format("Y-m-d H:i:s"));

                                $difference = $endDate->diff($startdate);
                                ?>
                                <div class="col-12 col-lg-9 text-end mt-3 mb-3">
                                    <label class="form-label fs-5 fw-bold text-success">
                                        <?php
                                        echo $difference->format('%Y') . " Years " . $difference->format('%M') . " Months " . $difference->format('%d') . " Days " .
                                            $difference->format('%H') . " Hours " . $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds ";
                                        ?>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="hrbreak2"></div>

                        <div class="col-12 mt-3 mb-2 text-dark">
                            <h2 class="w-bold">Selling History</h2>
                        </div>
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-5 offset-lg-1">
                                    <label class="form-label text-dark fs-6">From Date</label>
                                    <input type="date" class="form-control" id="fromdate" />
                                </div>
                                <div class="col-12 col-lg-5 offset-lg-1 mt-2 mt-lg-0">
                                    <label class="form-label text-dark fs-6 ">To Date</label>
                                    <input type="date" class="form-control" id="todate" />
                                </div>
                                <a href="" id="historylink" class="btn btn-primary col-8 offset-2 mt-2" onclick="dailysellings();">View Sellings</a>
                            </div>
                        </div>


                        <div class="hrbreak2 mt-3"></div>


                        <div class="offset-lg-2 offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light border border-danger">
                            <div class="row g-1">
                                <?php
                                $freq = Database::search("SELECT `user_email`,COUNT(`qty`) AS `totalqty`,`product_id`,COUNT(`product_id`) AS `value_occurrence`
                                 FROM `invoice`  GROUP BY `product_id` ORDER BY `value_occurrence`
                                 DESC LIMIT 1");

                                $freqnum = $freq->num_rows;

                                for ($z = 0; $z < $freqnum; $z++) {
                                    $freqrow = $freq->fetch_assoc();
                                    $proid = $freqrow["product_id"];
                                    $umail = $freqrow["user_email"];
                                }
                                ?>
                                <div class="col-12 text-center">
                                    <label class="form-label text-danger fs-4 fw-bold">Mostly Sold Food</label>
                                </div>
                                <?php
                                $prodata = Database::search("SELECT * FROM `product` WHERE `id`='" . $proid . "'");
                                $prod = $prodata->fetch_assoc();
                                ?>
                                <div class="col-12 text-center">
                                    <span class="fs-5 fw-bold"><?php echo $prod["title"] ?></span>
                                    <br />
                                    <span class="fs-6"><?php echo $freqrow["totalqty"]; ?> Items</span>
                                    <br />
                                    <!-- <span class="fs-6">Rs. <?php echo $prod["price"] ?>.00</span> -->
                                </div>
                                <!-- <div class="firstplace"></div> -->
                            </div>
                        </div>

                        <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light border border-danger">
                            <div class="row g-1">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 text-danger fw-bold">Mostly Famous Buyer</label>
                                </div>
                                <?php
                                $udata = Database::search("SELECT * FROM `user` WHERE `email`='" . $umail . "'");
                                $u = $udata->fetch_assoc();
                                ?>
                                <div class="col-12 text-center">
                                    <span class="fs-5 fw-bold"><?php echo $u["fname"] . " " . $u["lname"]; ?></span>
                                    <br />
                                    <span class="fs-6"><?php echo $umail; ?></span>
                                    <!-- <br />
                                    <span class="fs-6"><?php echo $u["mobile"]; ?></span> -->
                                </div>
                                <!-- <div class="firstplace"></div> -->
                            </div>
                        </div>

                    </div>
                </div>







                <?php require "footer.php"; ?>

            </div>
        </div>

        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>

<?php
}
?>