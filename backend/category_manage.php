<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['user_id']) {
    
} else {
    header('location:../index.php');
}
?>
<?php
include_once '../vendor/autoload.php';

use App\Categories;
//use App\Profiles;
//use App\Articles;

$categoryobj = new Categories();

$all_category = $categoryobj->select_all_categories();

//echo '<pre>';
//print_r($all_category);
//exit();
?>
<?php include_once 'admin_header.php';?>
                <div class="col-md-10" id="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="clearfix">
                                <h2 class="pull-left">Manage Categories</h2>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-box clearfix">

                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Category Name</th>
                                                    <th class="text-center"><span>Parent category</th>
                                                    <th class="text-center">Publication Status</th>
                                                    <th class="text-center">Created Date</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php
                                                foreach ($all_category as $v_category_info) {
                                                ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $v_category_info['title'];  ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($v_category_info['parent_id'] != 0){
                                                            $one_category = $categoryobj->select_one_categories($v_category_info['parent_id']);
                                                            echo $one_category['title'];
                                                        } else { echo "Parent Category"; }?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($v_category_info['publication_status'] == 1) { ?>
                                                            <a href = "category_unpublished.php?id=<?php echo $v_category_info['id']; ?>">
                                                                <span class = "label label-danger">Unpublised</span>
                                                            </a>
                                                        <?php } else { ?>
                                                            <a href = "category_published.php?id=<?php echo $v_category_info['id']; ?>">
                                                                <span class = "label label-success">Published</span>
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        $data = $v_category_info['created_at'];
                                                        $date_format = date('d M Y H:i A', strtotime($data));
                                                        echo $date_format;
                                                        ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="user_view.php?category_id=<?php echo $v_category_info['id']; ?>" class="table-link">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                        </a>
                                                        <a href="category_edit.php?category_id=<?php echo $v_category_info['id']; ?>" class="table-link">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                        </a>
                                                        <a href="article_delete.php?category_id=<?php echo $v_category_info['id']; ?>" class="table-link danger">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
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