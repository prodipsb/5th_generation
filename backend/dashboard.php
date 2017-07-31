<?php
session_start();
if ($_SESSION['user_id']) {
    
} else {
    header('location:../index.php');
}
include_once '../vendor/autoload.php';

use App\Articles;

$articleobj = new Articles();
$top_articles = $articleobj->select_all_articles();
$count_all_articles = $articleobj->select_all_articles_for_pagination();

use App\Profiles;

$profileobj = new Profiles();
$user_id = $_SESSION['user_id'];
$user_profile_info = $profileobj->view_user_details($user_id);
$user_all_info = $profileobj->view_all_users();

use App\Users;

$userobj = new Users();
$all_users = $userobj->select_all_users();
$all_admins = $userobj->select_all_admins();
$all_admins_info = $userobj->select_all_admins_with_profile_details();

//echo '<pre>';
//print_r($user_all_info);
//exit();

?>
            <?php include_once 'admin_header.php';?>
                
                <div class="col-md-10" id="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <div class="main-box infographic-box">
                                        <i class="fa fa-user red"></i>
                                        <span class="headline">Registered Users</span>
                                        <span class="value" style="margin-left:100px;"><?php echo count($all_users);?></span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <div class="main-box infographic-box">
                                        <i class="fa fa-eye yellow"></i>
                                        <span class="headline">Admin</span>
                                        <span class="value" style="margin-left:70px;"><?php echo count($all_admins);?></span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <div class="main-box infographic-box">
                                        <i class="fa fa-money green"></i>
                                        <span class="headline">Total Articles </span>
                                        <span class="value" style="margin-left:100px;"><?php echo $count_all_articles;?></span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-xs-12" >
                                    <div class="main-box infographic-box">
                                        <i class="fa fa-eye yellow"></i>
                                        <span class="headline">Active users</span>
                                        <span class="value" style="margin-left:100px;">1</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8 col-lg-9">
                                    <div class="main-box">
                                        <div class="clearfix">
                                            <h1 class="center-block">
                                                <span style=" margin-left: 200px;">
                                                    <?php
                                                    if (isset($_SESSION['login_succ_mgs'])) {
                                                        echo $_SESSION['login_succ_mgs'];
                                                        unset($_SESSION['login_succ_mgs']);
                                                    }
                                                    ?>
                                                   
                                                </span>
                                            </h1>

                                        </div>
                                        <style type="text/css">
                                            .widget ul li{margin-bottom: 10px; text-transform: capitalize;}
                                            .widget ul li a{font-size: 20px; color:  #4F4F4F;}
                                        </style>
                                       

                                        <div class="" style="height: 500px;">
                                            <div class="col-md-12">
                                                <div class="widget">
                                                <h2>Top 10 Recent Posts</h2><hr>
                                                
                                                    <ul class="cat">
                                                        <?php
                                                        foreach ($top_articles as $v_article) {
                                                            ?>
                                                            <li><i class="icon-angle-right"></i></i><a href="article_view.php?id=<?php echo $v_article['article_id']; ?>"><?php echo $v_article['title'] ?></a></li>
                                                        <?php } ?>

                                                </ul>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-12">
                                            <div class="main-box clearfix">
                                                <h2>Top 10 users List</h2>

                                                <ul>
                                                    <?php 
                                                        foreach($user_all_info as $v_user){
                                                    ?>
                                                    <li><h5><?php echo $v_user['firstname'].' '.$v_user['lastname']?></h5></li>
                                                        <?php }?>
                                                </ul>
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
        <?php include_once 'admin_footer.php';?>