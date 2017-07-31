<?php
include_once '../vendor/autoload.php';

use App\Categories;

$categoryobj = new Categories();
$categories_info = $categoryobj->select_all_categories();

use App\Menus;

$menuobj = new Menus();
$menus_info = $menuobj->select_all_published_menus();

//echo '<pre>';
//print_r($categories_info);
//exit();
?>


                        <?php include_once 'admin_header.php';?>

                <div class="col-md-10" id="content-wrapper">
                    <div class="row">
                        <h4 style="color: green; text-align: center;">
                            <?php
                            if (isset($_SESSION['article_save_mgs'])) {
                                echo $_SESSION['article_save_mgs'];
                                unset($_SESSION['article_save_mgs']);
                            }
                            ?>
                        </h4>
                        <div class="col-lg-12">
                            <form action="article_store.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8 col-lg-9">
                                        <div class="main-box">
                                            <div class="clearfix">

                                                <h2>Add New Article</h2>

                                                <div class="form-group">
                                                    <label for="title"><h4>Title</h4></label>
                                                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter A Title" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sub_title"><h4>Sub title</h4></label>
                                                    <input type="text" name="sub_title" class="form-control" id="title" placeholder="Enter A Sub Title" required>
                                                </div>

                                                
                                                <div class="form-group">
                                                    <label for="myeditor"><h4>Summary</h4></label>
                                                    <textarea name="summary" class="ckeditor" id="myeditor" rows="4" cols="50" required required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="myeditor"><h4>Details</h4></label>
                                                    <textarea name="details" class="ckeditor" id="myeditor" rows="4" cols="50" required required></textarea>
                                                </div>
                                                
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="graph-line" style="max-height: 290px;"></div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="row">

                                            <div class="col-xs-12 col-sm-6 col-md-12">
                                                <div class="main-box clearfix">
                                                    <h2>Categories</h2>
                                                    <?php
                                                    foreach ($categories_info as $v_category) {
                                                        ?>
                                                        <input type="checkbox" name="category_id[]" value="<?php echo $v_category['id']; ?>"><?php echo $v_category['title']; ?><br>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-12">
                                                <div class="main-box clearfix">
                                                    <h2>Publication Status</h2>
                                                    <input type="radio" name="publication_status" value="0" > Save To Draft <br>
                                                    <input type="radio" name="publication_status" value="1" > Publish Now

                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-12">
                                                <div class="main-box clearfix">
                                                    <h2>Feature Image</h2>
                                                    <h4>Choose a Image</h4>
                                                    <img id="thumbnil" style="width:100%; height: 150px; margin-bottom: 15px; border-radius: 5px;"  src="" alt=""/>
                                                    <input class="fileinput fileinput-new" type="file" name="image_name" onchange="showMyImage(this)">
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-12">
                                                <div class="main-box clearfix">
                                                    <div id="hero-donut" style="height: 212px; padding: 0; margin: 0;"></div>
                                                </div>
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
