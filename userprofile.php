<!DOCTYPE html>

<html>

<head>
    <title>Zuki | User Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/zukilogo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>



    <div class="container-fluid">
        <div class="row">



            <?php
            session_start();
            require "connection.php";
            if (isset($_SESSION["u"])) {
            ?>

                <!-- header -->
                <?php
                require "header.php";
                ?>
                <!-- header -->

                <div class="col-12 bg-danger">
                    <div class="row bg-white rounded mt-5 mb-5">


                        <div class="col-md-12 border-end">
                            <div class="p-5 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 style="font-weight: bold; " class="text-danger">Profile Settings</h4>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">First name</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="first name" value="<?php echo $_SESSION["u"]["fname"]; ?>" id="fname" />
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Last name</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="last name" value="<?php echo $_SESSION["u"]["lname"]; ?>" id="lname" />
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter Phone Number" value="<?php echo $_SESSION["u"]["mobile"]; ?>" id="mobile" />
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control form-control-sm" placeholder="Password" readonly value="<?php echo $_SESSION["u"]["password"]; ?>" />
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter Email Address" readonly value="<?php echo $_SESSION["u"]["email"]; ?>" />
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Registered Date & Time</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Registered Date" readonly value="<?php echo $_SESSION["u"]["register_date"]; ?>" />
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Gender</label>
                                        <?php
                                        $gen_id = $_SESSION["u"]["gender_id"];
                                        $gen = Database::search("SELECT * FROM `gender` WHERE `id`='" . $gen_id . "'");
                                        $gender = $gen->fetch_assoc();
                                        ?>
                                        <input type="text" class="form-control form-control-sm" placeholder="Gender" readonly value="<?php echo $gender["name"]; ?>" />
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <?php
                                    $useremail = $_SESSION["u"]["email"];
                                    $address = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $useremail . "'");
                                    $n = $address->num_rows;
                                    $d = $address->fetch_assoc();
                                    ?>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Address Line 01</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter Address Line 01" value="<?php echo $d["line1"] ?>" id="line1" />
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Address Line 02</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter Address Line 02" value="<?php echo $d["line2"] ?>" id="line2" />
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Enter Address Line 02" value="<?php echo $d["city"] ?>" id="city" />
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">District</label>
                                        <select class="form-control form-control-sm" id="district">
                                            <?php
                                            $districtid = $d["district_id"];
                                            $udist = Database::search("SELECT * FROM `district` WHERE `id`='" . $districtid . "'");
                                            $k = $udist->fetch_assoc();
                                            ?>
                                            <option value="<?php echo $k["id"]; ?>"><?php echo $k["name"]; ?></option>
                                            <?php
                                            $districtrs = Database::search("SELECT * FROM `district` WHERE `id`!='" . $k["id"] . "' ");
                                            $kn = $districtrs->num_rows;
                                            for ($j = 0; $j < $kn; $j++) {
                                                $dr = $districtrs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $dr["id"]; ?>"><?php echo $dr["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary" onclick="updateProfile();">Update Profile</button>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>





            <?php
            } else {
            ?>
                <script>
                    window.location = "index.php";
                </script>
            <?php
            }
            ?>


            <!-- footer -->
            <?php
            require "footer.php";
            ?>
            <!-- footer -->
        </div>
    </div>





    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>