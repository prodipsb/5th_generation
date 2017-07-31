<?php
include_once '../vendor/autoload.php';

use App\Categories;
use App\Menus;
use App\Articles;

$categoryobj = new Categories();
$categories_info = $categoryobj->select_all_categories();


$menuobj = new Menus();
$menus_info = $menuobj->select_all_menus();

$articleobj = new Articles();
$id = $_GET['id'];
$article_info = $articleobj->edit_article($id);
$images_info = $articleobj->select_all_article_image();


$cats = explode(',',$article_info['category_id']);
$article_info['category_id'] = $cats;



//echo '<pre>';
//print_r($images_info);
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
                            <form action="article_update.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8 col-lg-9">
                                        <div class="main-box">
                                            <div class="clearfix">
   
                                                <h2>Edit Article</h2>

                                                <div class="form-group">
                                                    <label for="title"><h4>Title</h4></label>
                                                     <input type="hidden" name="id" value="<?php echo $article_info['id']; ?>" class="form-control">
                                                     
                                                    <input type="text" name="title" value="<?php echo $article_info['title'];?>" class="form-control" id="title" placeholder="Enter A Title">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sub_title"><h4>Sub title</h4></label>
                                                    <input type="text" name="sub_title" value="<?php echo $article_info['sub_title']; ?>" class="form-control" id="sub_title" placeholder="Enter A Sub Title">
                                                </div>

                                                <div class="form-group">
                                                    <label for="myeditor"><h4>Summary</h4></label>
                                                    <textarea name="summary" class="ckeditor" id="myeditor" rows="4" cols="50" required>
                                                        <?php echo $article_info['html_summary']; ?>
                                                    </textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="myeditor"><h4>Details</h4></label>
                                                    <textarea name="details" class="ckeditor" id="myeditor" rows="4" cols="50" required>
                                                        <?php echo $article_info['html_details']; ?>
                                                    </textarea>
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
                                                        <input type="checkbox" name="category_id[]" value="<?php echo $v_category['id']; ?>" <?php if(in_array($v_category['id'],$article_info['category_id'])){echo 'checked';}?>><?php echo $v_category['title']; ?><br>
                                                    <?php } ?>
                                                    
                                                   

                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-12">
                                                <div class="main-box clearfix">
                                                    <h2>Publication Status</h2>
                                                    <input type="radio" name="publication_status" value="0" <?php if($article_info['publication_status'] == 0){echo 'checked';}?>> Save To Draft <br>
                                                    <input type="radio" name="publication_status" value="1" <?php if($article_info['publication_status'] == 1){echo 'checked';}?>> Publish Now

                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-12">
                                                <div class="main-box clearfix">
                                                    <h2>Feature Image</h2>
                                                    <h4>Choose a Image</h4>
                                                    <?php foreach($images_info as $v_image){
                                                        if($v_image['id'] == $article_info['image_id']){?>
                                                    <img src="<?php echo '../img/article_feature_images/'.$v_image['image_name'];?>"  style="width:100%; height: 150px; margin-bottom: 15px; border-radius: 5px;"  alt=""/>
                                                    <?php }}?>
                                                    
                                                    <input class="fileinput fileinput-new" type="file" name="image_name" id="uploaded_image" onchange="showMyImage(this)">
                                                    <div id="preview_image" style="display: none;">
                                                        <h3>Preview</h3>
                                                        <img id="thumbnil" style="width:100%; height: 150px; margin-bottom: 15px; border-radius: 5px;"  src="" alt=""/>
                                                    </div>
                                                </div>
                                            </div>
                                            <script src="../js/jquery.js"></script>
                                            <script type="text/javascript">
                                                $(document).ready(function(){
                                                    $('#uploaded_image').change(function(){
                                                        $('#preview_image').show();
                                                    });
                                                });
                                            </script>
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
   <?php include_once 'admin_footer.php';?>