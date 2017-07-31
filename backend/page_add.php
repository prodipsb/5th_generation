<?php
include_once '../vendor/autoload.php';

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>SuperheroAdmin - Bootstrap Admin Template</title>

        <!-- bootstrap -->
        <link href="../css/bootstrap/bootstrap.css" rel="stylesheet" />

        <!-- libraries -->
        <!-- <link href="css/libs/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" /> -->
        <link href="../css/libs/font-awesome.css" type="text/css" rel="stylesheet" />

        <!-- global styles -->
        <link rel="stylesheet" type="text/css" href="../css/compiled/layout.css">
        <link rel="stylesheet" type="text/css" href="../css/compiled/elements.css">



        <!-- Favicon -->
        <link type="image/x-icon" href="../favicon.png" rel="shortcut icon"/>

        <!-- google font libraries -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400' rel='stylesheet' type='text/css'>


    </head>
    <body>
        <?php include_once 'admin_header_bar.php'; ?>
        <div class="container">

            <div class="row">


                <div class="col-md-2" id="nav-col">
                    <?php include_once 'admin_left_sidebar.php'; ?>
                </div>

                <div class="col-md-10" id="content-wrapper">
                    <div class="row">
                        <h4 style="color: green; text-align: center;">
                            <?php
                            if (isset($_SESSION['page_save_mgs'])) {
                                echo $_SESSION['page_save_mgs'];
                                unset($_SESSION['page_save_mgs']);
                            }
                            ?>
                        </h4>
                        <div class="col-lg-12">
                            <form action="page_store.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8 col-lg-12">
                                        <div class="main-box">
                                            <div class="clearfix">

                                                <h2>Add New Page</h2>

                                                <div class="form-group">
                                                    <label for="title"><h4>Title</h4></label>
                                                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter A Title">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sub_title"><h4>Sub title</h4></label>
                                                    <input type="text" name="sub_title" class="form-control" id="title" placeholder="Enter A Sub Title">
                                                </div>


                                                <div class="form-group">
                                                    <label for="myeditor"><h4>Details</h4></label>
                                                    <textarea name="details" class="ckeditor" id="myeditor" rows="4" cols="50" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="myeditor"><h4>Summary</h4></label>
                                                    <textarea name="summary" class="ckeditor" id="myeditor" rows="4" cols="50" required></textarea>
                                                </div>




                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="graph-line" style="max-height: 290px;"></div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <input type="submit" class="btn btn-default submit" value="Save">
                                <input type="reset" class="btn btn-default submit"  value="Reset">
                            </form>


                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer id="footer-bar">
        <p id="footer-copyright">
            &copy; 2014 <a href="http://www.adbee.sk/" target="_blank">Adbee digital</a>. Powered by SuperheroAdmin.
        </p>
    </footer>

    <!-- global scripts -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>



    <!-- theme scripts -->
    <script src="../js/scripts.js"></script>
    <script src="../third party/ckeditor/ckeditor.js"></script>
    <script>CKEDITOR.replace('#myeditor');</script>



    <script>
        function showMyImage(fileInput) {
            var files = fileInput.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var imageType = /image.*/;
                if (!file.type.match(imageType)) {
                    continue;
                }
                var img = document.getElementById("thumbnil");
                img.file = file;
                var reader = new FileReader();
                reader.onload = (function (aImg) {
                    return function (e) {
                        aImg.src = e.target.result;
                    };
                })(img);
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>
</html>
