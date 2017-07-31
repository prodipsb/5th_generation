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
//$all_users = $userobj->view_all_users();

//$user_all_info = $profileobj->view_all_users();
$id = $_GET['id'];
$article_info = $articleobj->single_article_view($id);
//echo '<pre>';
//print_r($article_info);
//exit();
?>
<?php include_once 'admin_header.php'; ?>

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
                <h2 class="pull-left">View Articles</h2>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box clearfix">
                        <div class="table-responsive">
                            <table class="table user-list">



                               

                                    <div class="col-lg-8">
                                        <article>
                                            <div class="post-image">
                                                <div class="post-heading">
                                                    <h3><a href="#"><?php echo $article_info['title']; ?></a></h3>
                                                </div>
                                                <img src="<?php echo '../img/article_feature_images/' . $article_info['image_name']; ?>" width="700" height="200" style="height: 400px;" alt="" />
                                            </div>
                                            <p>
                                                <?php echo htmlspecialchars_decode($article_info['html_details']); ?>
                                            </p>

                                        </article>

                                    </div>

                             

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
<?php include_once 'admin_footer.php'; ?>