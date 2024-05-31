<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="col-12 bg-dark">
        <div class="row mt-1">

            <div class="col-2 offset-1 col-lg-1 offset-lg-1 align-self-start d-grid" style="text-align: center;">
                <div class="row  mb-1 mt-lg-0 mt-1">
                    <div class="dropdown col-12">
                        <div class="menudrop" style="cursor: pointer;" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></div>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item text-white" href="home.php">Home</a></li>
                            <li><a class="dropdown-item text-white" href="purchasehistory.php">Purchase History</a></li>
                            <!-- <li><a class="dropdown-item text-white" href="">Message</a></li> -->
                            <li><a class="dropdown-item text-white" style="cursor: pointer;" onclick="cmodal();">Contact & Location</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-9 col-lg-3 mt-1 align-self-start" >
                <?php
                if (isset($_SESSION["u"])) {
                    $username = $_SESSION["u"]["fname"];
                ?>
                    <span class="text-start text-white label1"><b>Welcome</b> <?php echo $username; ?> |
                        <span class="text-start text-white label2" onclick="signout();">Sign Out</span>
                    <?php
                } else {
                    ?>
                        <a class="text-white" href="index.php">Hi! Sign in or register</a>
                    <?php
                }

                    ?>
                    </span>
            </div>
            <div class="col-lg-3 mt-1 offset-lg-4">
                <span class="text-start text-white label1 d-none d-lg-block">ZUKI-NIGHT RESTAURANT</span>
            </div>
        </div>
    </div>


    <div class="modal" id="contactmodal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Help & Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="text-primary"><b>Voice :</b> 0772040600</span> <br />
                    <span class="text-success"><b>Whatsapp :</b> 0772040600</span><br /><br />
                    <span><b>Location :</b></span><br />
                    <span>No/85,Mihiriyagama</span><br />
                    <span>Dankotuwa</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



</body>

</html>