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

use App\Menus;

$menuobj = new Menus();

$all_menus = $menuobj->select_all_menus();

//echo '<pre>';
//print_r($all_menus);
//exit();
?>
<?php include_once 'admin_header.php';?>

                <div class="col-md-10" id="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 style="color: green; text-align: center;">
                            <?php
                            if (isset($_SESSION['menu_updated_mgs'])) {
                                echo $_SESSION['menu_updated_mgs'];
                                unset($_SESSION['menu_updated_mgs']);
                            }
                            ?>
                        </h4>
                            <div class="clearfix">
                                <h2 class="pull-left">Manage Menus</h2>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-box clearfix">

                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th class="text-left">Menu Name</th>
                                                    <th class="text-center">Parent Menu</th>
                                                    <th class="text-center">Publication Status</th>
                                                    <th class="text-center">Created Date</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php
                                                foreach ($all_menus as $v_menu_info) {
                                                ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $v_menu_info['title'];  ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($v_menu_info['parent_id'] != 0){
                                                            $one_menu = $menuobj->single_menu($v_menu_info['parent_id']);
                                                            echo $one_menu['title'];
                                                        } else { echo "Parent Menu"; }?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($v_menu_info['publication_status'] == 1) { ?>
                                                            <a href = "menu_unpublished.php?id=<?php echo $v_menu_info['id']; ?>">
                                                                <span class = "label label-danger">Unpublised</span>
                                                            </a>
                                                        <?php } else { ?>
                                                            <a href = "menu_published.php?id=<?php echo $v_menu_info['id']; ?>">
                                                                <span class = "label label-success">Published</span>
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        $data = $v_menu_info['created_at'];
                                                        $date_format = date('d M Y H:i A', strtotime($data));
                                                        echo $date_format;
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="user_view.php?category_id=<?php echo $v_menu_info['id']; ?>" class="table-link">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                        </a>
                                                        <a href="menu_edit.php?id=<?php echo $v_menu_info['id']; ?>" class="table-link">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                        </a>
                                                        <a href="article_delete.php?category_id=<?php echo $v_menu_info['id']; ?>" class="table-link danger">
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