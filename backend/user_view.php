<?php
if (!isset($_SESSION)) {
    session_start();
}

//echo '<pre>';
//print_r($_SESSION);
//exit();

if ($_SESSION['user_id']) {
    
} else {
    header('location:../index.php');
}

include_once '../vendor/autoload.php';

use App\Users;
use App\Profiles;
use App\Articles;

$articleobj = new Articles();
$profileobj = new Profiles();
$userobj = new Users();
$id = $_GET['id'];
$user_info = $userobj->view_user($id);
$user_profile_info_by_user_id = $profileobj->view_user_details($id);
//$user_view = $profileobj->view_user_details_by_id($id);

 $count_posted_articles = $articleobj->count_all_articles_by_user_id($id);
//echo '<pre>';
//print_r($user_profile_info_by_user_id);
//exit();
 
 
?>
<?php include_once 'admin_header.php';?>

                <div class="col-md-10" id="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12">

                            <h1>
                                <?php
                                if ($user_info['is_admin'] == 1) {
                                    echo 'Admin';
                                } else {
                                    echo 'User';
                                }
                                ?> Profile
                            </h1>
                            <div class="row" id="user-profile">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <div class="main-box clearfix">
                                        <h2 style="text-transform: capitalize;">
                                            <?php 
//                                                echo '<pre>';
//                                                print_r($user_view);
//                                                exit();
                                            ?>
                                            <?php
                                            if (isset($user_profile_info_by_user_id['firstname'], $user_profile_info_by_user_id['lastname']) && !empty($user_profile_info_by_user_id['firstname'])) {
                                                echo $user_profile_info_by_user_id['firstname'].' '.$user_profile_info_by_user_id['lastname'];
                                            } else {
                                                echo $user_info['username'];
                                            }
                                            ?>
                                        </h2>

                                        <div class="profile-status">
                                            <i class="fa fa-check-circle"></i> Online
                                        </div>
                                        <?php if (isset($user_profile_info_by_user_id['image']) && !empty($user_profile_info_by_user_id['image'])) { ?>
                                            <img src="../img/profile_pics/<?php echo $user_profile_info_by_user_id['image']; ?>" width="159" height="159" alt="" class="profile-img img-responsive center-block"/>
                                        <?php } else { ?>
                                            <img src="../img/samples/Unknown_Person.png" width="159" height="159" alt="" class="profile-img img-responsive center-block"/>
                                            
                                        <?php } ?>


                                        <div class="profile-label">
                                            <span class="label label-danger">
                                                <?php
                                                if ($user_info['is_admin'] == 1) {
                                                    echo 'Admin';
                                                } else {
                                                    echo 'User';
                                                }
                                                ?>
                                            </span>
                                        </div>

                                        

                                        <div class="profile-since" style="margin-top: 10px;">
                                            <?php
                                            if ($user_info['is_admin'] == 1) {
                                                echo 'Admin';
                                            } else {
                                                echo 'Member';
                                            }
                                            $created_date = $user_info['created_at'];
                                            ?>
                                            since: <?php echo date('M Y', strtotime($created_date)); ?>
                                        </div>

                                        <div class="profile-details">
                                            <ul class="fa-ul">
                                                <li><i class="fa-li fa fa-comment"></i>Posts: <span><?php echo $count_posted_articles;?></span></li>
                                            </ul>
                                        </div>

                                        <div class="profile-message-btn center-block text-center">
                                            <a href="../contact_us.php" class="btn btn-success">
                                                <i class="fa fa-envelope"></i>
                                                Send message
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-9 col-md-8 col-sm-8" >
                                    <span style="text-align: center; color: green; font-size: 18px">
                                        <?php
                                        if (array_key_exists('profile_save_mgs', $_SESSION) && !empty($_SESSION['profile_save_mgs'])) {
                                            echo $_SESSION['profile_save_mgs'];
                                            unset($_SESSION['profile_save_mgs']);
                                        }
                                        ?>
                                    </span>
                                    <div class="main-box clearfix" style="height: 420px;">
                                        <div class="profile-header">
                                            <h3>
                                                <span>
                                                    <?php
                                                    if ($user_info['is_admin'] == 1) {
                                                        echo 'Admin';
                                                    } else {
                                                        echo 'User';
                                                    }
                                                    ?> info
                                                </span>
                                            </h3>
                                            <a href="user_edit.php?id=<?php echo $user_info['id']; ?>" class="btn btn-primary edit-profile">
                                                <i class="fa fa-pencil-square fa-lg"></i> 
                                                Edit profile
                                            </a>
                                        </div>

                                        <div class="row profile-user-info">
                                            <div class="col-sm-8">
                                                <div class="profile-user-details clearfix">
                                                    <div class="profile-user-details-label">
                                                        First Name
                                                    </div>
                                                    <div class="profile-user-details-value" style="text-transform: capitalize;">
                                                        <?php 
                                                            if(isset($user_profile_info_by_user_id['firstname']) && !empty($user_profile_info_by_user_id['firstname'])){
                                                                echo $user_profile_info_by_user_id['firstname'];
                                                            }else{
                                                                echo '..................';
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="profile-user-details clearfix">
                                                    <div class="profile-user-details-label">
                                                        Last Name
                                                    </div>
                                                    <div class="profile-user-details-value" style="text-transform: capitalize;">
                                                        <?php 
                                                            if(isset($user_profile_info_by_user_id['lastname']) && !empty($user_profile_info_by_user_id['lastname'])){
                                                                echo $user_profile_info_by_user_id['lastname'];
                                                            }else{
                                                                echo '..................';
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="profile-user-details clearfix">
                                                    <div class="profile-user-details-label">
                                                        Address
                                                    </div>
                                                    <div class="profile-user-details-value">
                                                        <?php 
                                                            if(isset($user_profile_info_by_user_id['address']) && !empty($user_profile_info_by_user_id['address'])){
                                                                echo $user_profile_info_by_user_id['address'];
                                                            }else{
                                                                echo '..................<br>
                                                                      ..............';
                                                            }
                                                        ?>
                                                        
                                                    </div>
                                                </div>
                                                <div class="profile-user-details clearfix">
                                                    <div class="profile-user-details-label">
                                                        Email ID
                                                    </div>
                                                    <div class="profile-user-details-value">
                                                        <?php 
                                                            if(isset($user_profile_info_by_user_id['email']) && !empty($user_profile_info_by_user_id['email'])){
                                                                echo $user_profile_info_by_user_id['email'];
                                                            }else{
                                                                echo $user_info['email'];
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="profile-user-details clearfix">
                                                    <div class="profile-user-details-label">
                                                        Mobile No
                                                    </div>
                                                    <div class="profile-user-details-value">
                                                         <?php 
                                                            if(isset($user_profile_info_by_user_id['mobile_no']) && !empty($user_profile_info_by_user_id['mobile_no'])){
                                                                echo $user_profile_info_by_user_id['mobile_no'];
                                                            }else{
                                                                echo '..................';
                                                            }
                                                        ?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 profile-social">
                                                <ul class="fa-ul">
                                                    <li style="text-transform: lowercase;"><i class="fa-li fa fa-twitter-square"></i><a href="#">@<?php echo $user_profile_info_by_user_id['firstname'].$user_profile_info_by_user_id['lastname']?></a></li>
                                                    <li><i class="fa-li fa fa-linkedin-square"></i>
                                                        <a href="#">
                                                        <?php if(isset($user_profile_info_by_user_id['firstname'])){ 
                                                            echo $user_profile_info_by_user_id['firstname'].' '.$user_profile_info_by_user_id['lastname'];
                                                        }else {
                                                            echo '____________';
                                                        }
                                                        ?>
                                                        </a>
                                                    </li>
                                                    <li><i class="fa-li fa fa-facebook-square"></i>
                                                        <a href="#">
                                                            <?php if(isset($user_profile_info_by_user_id['firstname'])){ 
                                                            echo $user_profile_info_by_user_id['firstname'].' '.$user_profile_info_by_user_id['lastname'];
                                                        }else {
                                                            echo '____________';
                                                        }
                                                        ?>
                                                        </a>
                                                    </li>
                                                    <li style="text-transform: lowercase;"><i class="fa-li fa fa-skype"></i><a href="#"><?php echo trim($user_profile_info_by_user_id['firstname'].$user_profile_info_by_user_id['lastname'].'skyID')?></a></li>
                                                </ul>
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