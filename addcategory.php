<?php
require "connection.php";
?>

<!DOCTYPE html>

<html>

<head>
    <title>ZUKI - Admin - Add Category</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/zukilogo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="container-fluid">
        <div class="row ">

            <?php
            require "adminheader.php";
            ?>

            <!-- header -->
            <div class="col-12  bg-danger">
                <h3 class="h2 text-center mb-1 mt-1 text-white fw-bold">Add Category</h3>
            </div>
            <!-- header -->

            <div class="hrbreak2"></div>

            <div class="col-12 mt-3">
                <div class="row">
                    <div class="col-12 col-lg-6" style="margin-top:90px;">
                        <label class="form-label mb-3 lbl1">Enter a Category</label>
                        <input class="form-control" type="text" id="c" />
                    </div>
                    <div class="col-12 col-lg-5 offset-lg-1 mt-4 mt-lg-0">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1 mb-3">Add Image for Category</label>
                            </div>
                            <img src="resources/addproductimg.svg" class="col-5 col-lg-5 ms-2 img-thumbnail" id="prev" />
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12 col-lg-6 ms-lg-4 mt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <input class="d-none" type="file" accept="img/*" id="imguploader" />
                                                <label class="btn btn-primary col-5 col-lg-8" for="imguploader" onclick="changeImage();">Upload</label>
                                            </div>
                                            <!-- <div class="col-6 col-lg-4 d-grid mt-2 mt-lg-0">
                                        <button class="btn btn-primary">Upload</button>
                                    </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                <button class="btn btn-success searchbtn" onclick="addCategory();">Save</button>
            </div>

            <div class="hrbreak2"></div>

            <div class="col-12 mb-3 mt-3">
                <div class="row mx-2 border border-primary px-5">

                    <div class="row row-cols-1 row-cols-md-4 g-4 mb-4">
                        <?php
                        $cat = Database::search("SELECT * FROM `category`");
                        $n = $cat->num_rows;
                        for ($X = 0; $X < $n; $X++) {
                            $c = $cat->fetch_assoc();
                        ?>
                            <div class="col">
                                <div class="card h-100 border border-danger">
                                    <img src="<?php echo $c["code"]; ?>" class="card-img-top cardtopimg" alt="...">
                                    <div class="card-body">
                                        <h4 class="card-title text-success fw-bold"><?php echo $c["name"]; ?></h4>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="check2" onchange='catchangeStatus(<?php echo $c["id"]; ?>);' <?php
                                                                                                                                                                            if ($c["status_id"] == 2) {
                                                                                                                                                                                echo "checked";
                                                                                                                                                                            }
                                                                                                                                                                            ?> />
                                            <label class="form-check-label fw-bold text-info" for="check2" id="catchecklabel<?php echo $c["id"]; ?>">
                                                <?php
                                                if ($c["status_id"] == 2) {
                                                    echo "Activate Category";
                                                } else {
                                                    echo "Deactivate Category";
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-secondary d-grid" onclick='catsendid(<?php echo $c["id"]; ?>)'>Update</a>
                                    </div>
                                </div>
                            </div>



                            <!--update categry Modal -->
                            <div class="modal fade" id="addnewmodal<?php echo $c["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12" style="margin-top:90px;">
                                                <label class="form-label mb-3 lbl1">Enter a Category</label>
                                                <input class="form-control" type="text" id="ct" disabled value="<?php echo $c["name"] ?>" />
                                            </div>
                                            <div class="col-12 mt-4 mt-lg-0">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label lbl1 mb-3">Add Image for Category</label>
                                                    </div>
                                                    <img src="<?php echo $c["code"] ?>" class="col-6 col-lg-6 ms-2 img-thumbnail" id="catprev<?php echo $c["id"]; ?>" />
                                                    <div class="col-12 mb-3">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-6 ms-lg-4 mt-2">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <input class="d-none" type="file" accept="img/*" id="catimguploader<?php echo $c["id"]; ?>" />
                                                                        <label class="btn btn-primary col-5 col-lg-8" for="catimguploader<?php echo $c["id"]; ?>" onclick='changecatImage(<?php echo $c["id"]; ?>);'>Upload</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick='updatecategory(<?php echo $c["id"]; ?>);'>Save Category</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--update category Modal -->

                        <?php
                        }
                        ?>
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