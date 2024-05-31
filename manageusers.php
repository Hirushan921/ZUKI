<?php
require "connection.php";
session_start();

?>
<!DOCTYPE html>

<html>

<head>
    <title>ZUKI | Admin | Manage Users</title>
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
                <label class="form-label fs-2 fw-bold text-danger">Manage All Users</label>
            </div>

            <div class="col-12 bg-light rounded ">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control" id="searchtxt" />
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-danger" onclick="searchUser();">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hrbreak2"></div>

            <div class="col-12 mt-3 mb-2">
                <div class="row">
                    <div class="col-8 col-lg-11">
                        <div class="row">
                            <div class="col-3 col-lg-1 bg-success pt-2 pb-2 text-end">
                                <span class="fs-4 fw-bold text-white">No.</span>
                            </div>
                            <div class="col-9 col-lg-2 bg-success pt-2 pb-2">
                                <span class="fs-4 fw-bold text-white">User Name</span>
                            </div>
                            <div class="col-3 bg-success pt-2 pb-2 d-none d-lg-block">
                                <span class="fs-4 fw-bold text-white">Email</span>
                            </div>
                            <div class="col-2 bg-success pt-2 pb-2 d-none d-lg-block">
                                <span class="fs-4 fw-bold text-white">Address</span>
                            </div>
                            <div class="col-2 bg-success pt-2 pb-2 d-none d-lg-block">
                                <span class="fs-4 fw-bold text-white">Mobile</span>
                            </div>
                            <div class="col-2 bg-success pt-2 pb-2 d-none d-lg-block">
                                <span class="fs-4 fw-bold text-white">Registered Date</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-lg-1 bg-success pt-2 pb-2"></div>
                </div>
            </div>


            <div id="udiv">
                <?php
                $usersrs = Database::search("SELECT * FROM `user`");
                $d = $usersrs->num_rows;
                $row = $usersrs->fetch_assoc();

                $results_per_page = 6;

                $number_of_pages = ceil($d / $results_per_page);
                $pageno;
                if (isset($_GET["page"])) {
                    $pageno = $_GET["page"];
                } else {
                    $pageno = 1;
                }

                $offset = ($pageno - 1) * $results_per_page;

                $selectedrs = Database::search("SELECT * FROM `user` LIMIT  $results_per_page OFFSET $offset");
                $srn = $selectedrs->num_rows;

                $c = "0";

                while ($srow = $selectedrs->fetch_assoc()) {
                    $c = $c + 1;
                    $email = $srow["email"];
                    // echo $email;
                ?>

                    <div class="col-12 mb-2">
                        <div class="row">
                            <div class="col-8 col-lg-11" onclick="viewmsgmodal('<?php echo $email; ?>');">
                                <div class="row">
                                    <div class="col-3 col-lg-1 bg-light pt-2 pb-2 text-end border border-start-0 border-top-0 border-end border-bottom-0 border-success border-2">
                                        <span class="fs-5 fw-bold text-dark"><?php echo $c; ?></span>
                                    </div>
                                    <div class="col-9 col-lg-2 bg-light pt-2 pb-2 border border-start-0 border-top-0 border-end border-bottom-0 border-success border-2">
                                        <span class="fs-5 fw-bold text-dark"><?php echo $srow["fname"] . " " . $srow["lname"]; ?></span>
                                    </div>
                                    <div class="col-3 col-lg-3 bg-light pt-2 pb-2 d-none d-lg-block border border-start-0 border-top-0 border-end border-bottom-0 border-success border-2">
                                        <span class="fs-5 fw-bold text-dark"><?php echo $email; ?></span>
                                    </div>
                                    <?php
                                    $addq = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $email . "'");
                                    $add = $addq->fetch_assoc();
                                    ?>
                                    <div class="col-9 col-lg-2 bg-light pt-2 pb-2 d-none d-lg-block border border-start-0 border-top-0 border-end border-bottom-0 border-success border-2">
                                        <span class="fs-5 fw-bold text-dark"><?php echo $add["line1"]; ?>,</span><br />
                                        <span class="fs-5 fw-bold text-dark"><?php echo $add["line2"]; ?>,</span><br />
                                        <span class="fs-5 fw-bold text-dark"><?php echo $add["city"]; ?></span><br />
                                    </div>
                                    <div class="col-3 col-lg-2 bg-light pt-2 pb-2 d-none d-lg-block border border-start-0 border-top-0 border-end border-bottom-0 border-success border-2">
                                        <span class="fs-5 fw-bold text-dark"><?php echo $srow["mobile"]; ?></span>
                                    </div>
                                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block border border-start-0 border-top-0 border-end border-bottom-0 border-success border-2">
                                        <span class="fs-5 fw-bold text-dark"><?php
                                                                                $rd = $srow["register_date"];
                                                                                $splitrd = explode(" ", $rd);
                                                                                echo $splitrd[0];
                                                                                ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4 col-lg-1 bg-white pt-2 pb-2 d-grid">
                                <?php
                                $s = $srow["status_id"];
                                if ($s == "1") {
                                ?>
                                    <button class="btn btn-dark" style="height: 40px;" onclick="blockuser('<?php echo $srow['email']; ?>')">Block</button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn btn-dark" style="height: 40px;" onclick="blockuser('<?php echo $srow['email']; ?>')">Unblock</button>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>

                    <!-- modal  -->
                    <div class="modal fade" id="msgmodal<?php echo $email; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" onload="refresher('<?php echo $email; ?>');">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Message Box</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- msgs.php.....................................................-->
                                    <div class="col-12 py-5 px-4">
                                        <div class="row rounded overflow-hidden shadow">

                                            <div class="col-lg-5 col-12 px-0">
                                                <div class="bg-white">

                                                    <div class="bg-light px-4 py-2">
                                                        <h5 class="mb-0 py-1">Recent</h5>
                                                    </div>

                                                    <div class="messages-box">
                                                        <div class="list-group rounded-0" id="rcv">


                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-lg-7 col-12 px-0">
                                                <div class="row px-4 py-5 text-white chatbox" id="chatrow">
                                                    <!-- senders msg  -->

                                                    <!-- senders msg  -->

                                                    <!-- receivers msg  -->

                                                    <!-- receivers msg  -->
                                                </div>
                                            </div>


                                            <div class="col-12 col-lg-7 offset-lg-5">
                                                <div class="row ">

                                                    <!-- text  -->
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="input-group">
                                                                <input type="text" id="msgtxt" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
                                                                <div class="input-group-append">
                                                                    <button id="button-addon2" class="btn btn-link fs-1 bg-white" onclick="sendmessage('<?php echo $email; ?>');"> <i class="bi bi-cursor-fill"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- text  -->

                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <!-- msgs.php.....................................................-->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal  -->



                <?php
                }

                ?>

                <div class="col-12 text-center fw-bold mt-3 mb-3">
                    <div class="pagination">
                        <a href="<?php
                                    if ($pageno <= 1) {
                                        echo "#";
                                    } else {
                                        echo "?page=" . ($pageno - 1);
                                    }
                                    ?>">&laquo;</a>
                        <?php
                        for ($page = 1; $page <= $number_of_pages; $page++) {
                            if ($page == $pageno) {
                        ?>
                                <!-- <a href="sellerproductview.php?page=<?php echo $page; ?>" class="ms-1 active"><?php echo $page; ?></a> -->
                                <a href="<?php echo "?page=" . $page; ?>" class="ms-1 active"><?php echo $page; ?></a>
                            <?php
                            } else {
                            ?>
                                <!-- <a href="sellerproductview.php?page=<?php echo $page; ?>" class="ms-1"><?php echo $page; ?></a> -->
                                <a href="<?php echo "?page=" . $page; ?>"><?php echo $page; ?></a>
                        <?php
                            }
                        }
                        ?>
                        <a href="<?php
                                    if ($pageno >= $number_of_pages) {
                                        echo "#";
                                    } else {
                                        echo "?page=" . ($pageno + 1);
                                    }
                                    ?>">&raquo;</a>
                    </div>

                </div>

            </div>


            <div class="modal" tabindex="-1" id="almodal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Attention.</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Please Input email in search field...</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>



            <?php require "footer.php"; ?>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>