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

use App\Users;
use App\Profiles;
use App\Articles;

$articleobj = new Articles();
$profileobj = new Profiles();
$userobj = new Users();

$page1 = 0;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page == '' || $page == '1') {
        $page1 = 0;
    } else {
        $page1 = ($page * 5) - 5;
    }
}
//$all_articles_info = $articleobj->select_all_articles_for_pagi($page1);
//$all_users = $userobj->view_all_users();

//$user_all_info = $profileobj->view_all_users();

$article_info = $articleobj->manage_article($page1);
$number_of_articles_row_count_pagi = $articleobj->select_num_articles_for_manage_article_page();
//echo '<pre>';
//print_r($number_of_articles_row_count_pagi);
//exit();
?>
<?php include_once 'admin_header.php';?>

                <div class="col-md-10" id="content-wrapper">
                    <div class="row">
                        <h4 style="color: green; text-align: center;">
                            <?php
                            if (isset($_SESSION['article_mgs'])) {
                                echo $_SESSION['article_mgs'];
                                unset($_SESSION['article_mgs']);
                            }
                            ?>
                        </h4>
                        <div class="col-lg-12">

                            <div class="clearfix">
                                <h2 class="pull-left">Manage Articles</h2>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-box clearfix">
                                        <div class="table-responsive">
                                            <table class="table user-list">
                                                <thead>
                                                    <tr>
                                                        <th><span>Posted By</span></th>
                                                        <th><span>Article Title</span></th>
                                                        <th><span>Feature Image</span></th>
                                                        <th class="text-center"><span>Publication Status</span></th>
                                                        <th><span>Posted Date</span></th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    foreach ($article_info as $v_article_info) {
                                                        ?>
                                                        <tr>
                                                            <td style="width: 15%;">
                                                                <?php if (isset($v_article_info['image']) && !empty($v_article_info['image'])) { ?>
                                                                    <img src="../img/profile_pics/<?php echo $v_article_info['image']; ?>" width="50" height="50" alt="" class="profile-img img-responsive center-block"/>
                                                                <?php } else { ?>
                                                                    <img src="../img/samples/Unknown_Person.png" width="50" height="50" alt="" class="profile-img img-responsive center-block"/>

                                                                <?php } ?>
                                                                <a href="user_view.php?id=<?php echo $v_article_info['id']; ?>" class="user-link"><?php echo $v_article_info['firstname'] . ' ' . $v_article_info['lastname']; ?></a>
                                                                <span class="user-subhead">
                                                                    <?php
                                                                    if ($v_article_info['is_admin'] == 1) {
                                                                        echo "Admin";
                                                                    } else {
                                                                        echo "User";
                                                                    }
                                                                    ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <a href="article_view.php?id=<?php echo $v_article_info['article_id']; ?>"><?php echo $v_article_info['title']; ?></a>
                                                            </td>
                                                            <td>
                                                                <img src="<?php echo '../img/article_feature_images/'.$v_article_info['image_name']; ?>" width="200" height="100" alt="">
                                                                
                                                            </td>
                                                            <td class="text-center">
                                                                <?php if ($v_article_info['publication_status'] == 1) { ?>
                                                                <a href = "article_unpublished.php?id=<?php echo $v_article_info['article_id']; ?>">
                                                                        <span class = "label label-danger">Unpublised</span>
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a href = "article_published.php?id=<?php echo $v_article_info['article_id']; ?>">
                                                                        <span class = "label label-success">Published</span>
                                                                    </a>
                                                                <?php } ?>

                                                            </td>
                                                            <td style="width: 10%;">
                                                                <?php
                                                                $data = $v_article_info['created_at'];
                                                                $date_format = date('d M Y H:i A', strtotime($data));
                                                                echo $date_format;
                                                                ?>
                                                            </td>
                                                            <td style="width: 15%;">
                                                                <a href="article_view.php?id=<?php echo $v_article_info['article_id']; ?>" class="table-link">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                                </a>
                                                                <a href="article_edit.php?id=<?php echo $v_article_info['article_id']; ?>" class="table-link">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                                </a>
                                                                <a href="article_delete.php?id=<?php echo $v_article_info['article_id']; ?>" class="table-link danger">
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
                             <?php if ($number_of_articles_row_count_pagi > 5) { ?>
                                    <div class="row">
                                        <ul class="pagination pull-right">
                                      
                                            <?php
                                            $cout = $number_of_articles_row_count_pagi;


                                            $a = $cout / 5;
                                            $a = ceil($a);

                                            for ($b = 1; $b <= $a; $b++) {
                                                ?>
                                            <li> <a href="manage_article.php?page=<?php echo $b; ?>"><?php echo $b . ' '; ?></a></li>


                                        <?php } ?>
                                      

                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
       <?php include_once 'admin_footer.php';?>