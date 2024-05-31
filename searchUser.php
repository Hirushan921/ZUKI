<?php
require "connection.php";

if (isset($_GET["s"])) {
    $text = $_GET["s"];

    if (!empty($text)) {
        $userrs = Database::search("SELECT * FROM `user` WHERE `email` LIKE '%" . $text . "%'");
        $unum = $userrs->num_rows;
?>
        <div style="margin-bottom:200px;">
            <?php

            $l = "0";
            for ($n = 0; $n < $unum; $n++) {
                $l = $l + 1;
                $row = $userrs->fetch_assoc();

            ?>
                <div class="col-12 mb-2">
                        <div class="row">
                            <div class="col-8 col-lg-11" onclick='viewmsgmodal("<?php echo $row["email"]; ?>");'>
                                <div class="row">
                                    <div class="col-3 col-lg-1 bg-light pt-2 pb-2 text-end border border-start-0 border-top-0 border-end border-bottom-0 border-success border-2">
                                        <span class="fs-5 fw-bold text-dark"><?php echo $l; ?></span>
                                    </div>
                                    <div class="col-9 col-lg-2 bg-light pt-2 pb-2 border border-start-0 border-top-0 border-end border-bottom-0 border-success border-2">
                                        <span class="fs-5 fw-bold"><?php echo $row["fname"] . " " . $row["lname"]; ?></span>
                                    </div>
                                    <div class="col-3 col-lg-3 bg-light pt-2 pb-2 d-none d-lg-block border border-start-0 border-top-0 border-end border-bottom-0 border-success border-2">
                                        <span class="fs-5 fw-bold text-dark"><?php echo $row["email"]; ?></span>
                                    </div>
                                    <?php
                                    $addq = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $row["email"] . "'");
                                    $add = $addq->fetch_assoc();
                                    ?>
                                    <div class="col-9 col-lg-2 bg-light pt-2 pb-2 d-none d-lg-block border border-start-0 border-top-0 border-end border-bottom-0 border-success border-2">
                                        <span class="fs-5 fw-bold"><?php echo $add["line1"]; ?>,</span><br/>
                                        <span class="fs-5 fw-bold"><?php echo $add["line2"]; ?>,</span><br/>
                                        <span class="fs-5 fw-bold"><?php echo $add["city"]; ?></span><br/>
                                    </div>
                                    <div class="col-3 col-lg-2 bg-light pt-2 pb-2 d-none d-lg-block border border-start-0 border-top-0 border-end border-bottom-0 border-success border-2">
                                        <span class="fs-5 fw-bold text-dark"><?php echo $row["mobile"]; ?></span>
                                    </div>
                                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block border border-start-0 border-top-0 border-end border-bottom-0 border-success border-2">
                                        <span class="fs-5 fw-bold"><?php
                                                                    $rd = $row["register_date"];
                                                                    $splitrd = explode(" ", $rd);
                                                                    echo $splitrd[0];
                                                                    ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4 col-lg-1 bg-white pt-2 pb-2 d-grid">
                                <?php
                                $s = $row["status_id"];
                                if ($s == "1") {
                                ?>
                                    <button class="btn btn-danger" style="height: 40px;" onclick="blockuser('<?php echo $row['email']; ?>')">Block</button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn btn-success" style="height: 40px;" onclick="blockuser('<?php echo $row['email']; ?>')">Unblock</button>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
            <?php
            }
            ?>
        </div>
<?php
    } else {
        echo "no";
    }
}



?>