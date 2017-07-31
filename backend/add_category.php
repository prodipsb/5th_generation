<?php
include_once '../vendor/autoload.php';

use App\Categories;

$categoryobj = new Categories();
$categories_info = $categoryobj->select_all_categories();

//echo '<pre>';
//print_r($categories_info);
//exit();
?>


        <?php include_once 'admin_header.php';?>
        <div class="col-md-10" id="content-wrapper">
            <div class="row">
                <h4 style="color: green; text-align: center;">
                    <?php
                    if (isset($_SESSION['category_save_mgs'])) {
                        echo $_SESSION['category_save_mgs'];
                        unset($_SESSION['category_save_mgs']);
                    }
                    ?>
                </h4>
                <div class="col-lg-12">

                    <div class="row">
                        <div class="col-md-8 col-lg-9">
                            <div class="main-box">
                                <form action="category_store.php" method="POST" enctype="multipart/form-data">
                                    <div class="clearfix">
                                        <h2>Add Category</h2>
                                        <div class="col-lg-6">


                                            <div class="form-group">
                                                <label for="title"><h4>Category Name</h4></label>
                                                <input type="text" name="title" class="form-control" id="title"
                                                       placeholder="Enter A Title" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label for="title"><h4>Parent category</h4></label>
                                                <select name="parent_id" class="form-control">
                                                    <option value="">Select parent category</option>
                                                    <?php
                                                    foreach ($categories_info as $v_category) {
                                                        ?>
                                                        <option
                                                            value="<?php echo $v_category['id']; ?>"><?php echo $v_category['title']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <label for="myeditor"><h4>Description</h4></label>
                                                <textarea name="category_des" class="ckeditor" id="myeditor" rows="4"
                                                          cols="50" required required></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label for="title"><h4>Publication status</h4></label><br/>
                                                    <input type="radio" name="publication_status" value="1">
                                                    Published<br/>
                                                    <input type="radio" name="publication_status" value="0"> Unpublished
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-default submit" value="Save">
                                        <input type="reset" class="btn btn-default submit" value="Reset">

                                    </div>
                                </form>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-12">

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
                                            <input type="checkbox" name="category_id[]"
                                                   value="<?php echo $v_category['id']; ?>"><?php echo $v_category['title']; ?>
                                            <br>
                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-12">
                                    <div class="main-box clearfix">
                                        <h2>Menus</h2>
                                        <h4>Select Menu</h4>
                                        <select name="menu_id" class="form-control">
                                            <option value="1">News</option>
                                            <option value="2">Sports</option>
                                            <option value="3">National</option>
                                            <option value="4">International</option>
                                            <option value="5">Science-fiction</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-12">
                                    <div class="main-box clearfix">
                                        <h2>Feature Image</h2>
                                        <h4>Choose a Image</h4>
                                        <img id="thumbnil"
                                             style="width:100%; height: 150px; margin-bottom: 15px; border-radius: 5px;"
                                             src="" alt=""/>
                                        <input class="fileinput fileinput-new" type="file" name="image_name"
                                               onchange="showMyImage(this)">
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


                </div>


            </div>
        </div>
    </div>
</div>
</div>
<?php include_once 'admin_footer.php';?>

</body>
</html>
