<?php
include_once '../vendor/autoload.php';
$id = $_GET['id'];
use App\Menus;
use App\Pages;
use App\Categories;

$menuobj = new Menus();
$pageobj = new Pages();
$categoryobj = new Categories();
$menus = $menuobj->select_parent_menus();
$single_menu = $menuobj->single_menu($id);
$page_all = $pageobj->select_all_pages();
$category_all = $categoryobj->select_all_categories();


//echo '<pre>';
//print_r($single_menu);
//exit();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SuperheroAdmin - Bootstrap Admin Template</title>

    <!-- bootstrap -->
    <link href="../css/bootstrap/bootstrap.css" rel="stylesheet"/>

    <!-- libraries -->
    <!-- <link href="css/libs/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" /> -->
    <link href="../css/libs/font-awesome.css" type="text/css" rel="stylesheet"/>

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="../css/compiled/layout.css">
    <link rel="stylesheet" type="text/css" href="../css/compiled/elements.css">


    <!-- Favicon -->
    <link type="image/x-icon" href="../favicon.png" rel="shortcut icon"/>

    <!-- google font libraries -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400'
          rel='stylesheet' type='text/css'>


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
                    if (isset($_SESSION['menu_save_mgs'])) {
                        echo $_SESSION['menu_save_mgs'];
                        unset($_SESSION['menu_save_mgs']);
                    }
                    ?>
                </h4>
                <div class="col-lg-12">

                    <div class="row">
                        <div class="col-md-10 col-lg-12">
                            <div class="main-box">
                                <form action="menu_store.php" method="POST">
                                    <div class="clearfix">
                                        <h2>Add Menu</h2>
                                        <div class="col-lg-6">

                                            <input type="hidden" name="id" value="<?php echo $single_menu['id'] ?>">
                                            <div class="form-group">
                                                <label for="title"><h4>Menu Name</h4></label>
                                                <input type="text" name="title" class="form-control" id="title"
                                                       placeholder="Enter A Title" value="<?php echo $single_menu['title'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label for="title"><h4>Parent Menu</h4></label>
                                                <select name="parent_id" class="form-control">
                                                    <option value="">Select Parent Menu</option>
                                                    <?php
                                                    foreach ($menus as $v_menu) {
                                                        ?>
                                                        <option
                                                            value="<?php echo $v_menu['id']; ?>"<?php if ($v_menu['id'] == $single_menu['parent_id']){ echo "selected";} ?>><?php echo $v_menu['title']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="title"><h4>Menu URL</h4></label>
                                            <input type="text" name="url" class="form-control" id="title"
                                                   placeholder="Enter Menu Url" value="<?php echo $single_menu['url']; ?>">
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="title"><h4>Categories</h4></label><br>
                                                    <?php foreach ($category_all as $category){ ?>
                                                        <input type="radio" name="url"
                                                               value="<?php echo "category_archive.php?category_id=".$category['id']; ?>"<?php if ("category_archive.php?category_id=".$category['id'] == $single_menu['url']){ echo "checked";} ?>><?php echo $category['title']; ?><br>

                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="title"><h4>Pages</h4></label><br>
                                                    <?php foreach ($page_all as $page){ ?>
                                                        <input type="radio" name="url"
                                                               value="<?php echo "page.php?id=".$page['id']; ?>"<?php if ("page.php?id=".$page['id'] == $single_menu['url']){ echo "checked";} ?>><?php echo $page['title']; ?><br>

                                                    <?php } ?>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="myeditor"><h4>Description</h4></label>
                                                <textarea name="menu_des" class="ckeditor" id="myeditor" rows="4"
                                                          cols="50" required><?php echo $single_menu['menu_des'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><h4>Publication Status</h4></label><br>
                                            <input type="radio" name="publication_status" value="0" <?php if ($single_menu['publication_status'] == 0) {
                                            echo 'checked';
                                        } ?>> Save To Draft <br>
                                            <input type="radio" name="publication_status" value="1" <?php if ($single_menu['publication_status'] == 1) {
                                            echo 'checked';
                                        } ?>> Publish Now
                                        </div>

                                        
                                        <input type="submit" class="btn btn-default submit" value="Save">
                                        <input type="reset" class="btn btn-default submit" value="Reset"></div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="graph-line" style="max-height: 290px;"></div>
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
