<?php
include_once '../vendor/autoload.php';
?>

<?php include_once 'admin_header.php';?>

                <div class="col-md-10" id="content-wrapper">
                    <div class="row">
                        <h4 style="color: green; text-align: center;">
                            <?php
                            if (isset($_SESSION['slider_saved_mgs'])) {
                                echo $_SESSION['slider_saved_mgs'];
                                unset($_SESSION['slider_saved_mgs']);
                            }
                            ?>
                        </h4>
                        <div class="col-lg-12">
                            <form action="slider_store.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8 col-lg-12">
                                        <div class="main-box">
                                            <div class="clearfix">

                                                <h2>Add New Slider</h2>

                                                <div class="form-group">
                                                    <label for="title"><h4>Title</h4></label>
                                                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Slider Title">
                                                </div>


                                                <div class="form-group">
                                                    <label for="myeditor"><h4>Caption Text</h4></label>
                                                    <textarea name="caption" class="ckeditor" id="myeditor" rows="4" cols="50" required></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">

                                                        <div class="form-group">
                                                            <label for="title"><h4>Choose Slider Image</h4></label>
                                                            <img id="thumbnil" style="width:100%; height: 250px; margin-bottom: 15px; border-radius: 5px;"  src="" alt=""/>
                                                            <input type="file" name="slider_image" onchange="showMyImage(this)" class="form-control" id="title">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">

                                                        <div class="form-group">
                                                            <label for="title"><h4>Publication status</h4></label><br/>
                                                            <input type="radio" name="publication_status" value="1">  Published<br/>
                                                            <input type="radio" name="publication_status" value="0">  Unpublished
                                                        </div>
                                                    </div>
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
   <?php include_once 'admin_footer.php';?>