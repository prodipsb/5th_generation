<?php
if(!isset($_SESSION)){
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

$profileobj = new Profiles();
$userobj = new Users();
$all_users = $userobj->deleted_users();

//$user_all_info = $profileobj->view_all_users();
//echo '<pre>';
//print_r($user_profile_info);
//exit();
?>
<?php include_once 'admin_header.php';?>

                <div class="col-md-10" id="content-wrapper">
                    
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="clearfix">
                                <h2 class="pull-left">Deleted Users</h2>
                                <span style="text-align: center; margin-left: 250px; color: green; font-size: 18px">
                                        <?php
                                        if (array_key_exists('profile_save_mgs', $_SESSION) && !empty($_SESSION['profile_save_mgs'])) {
                                            echo $_SESSION['profile_save_mgs'];
                                            unset($_SESSION['profile_save_mgs']);
                                        }
                                        ?>
                                    </span>
                                <div class="pull-right top-page-ui">
                                    <a href="users.php" class="btn btn-primary">
                                        <i class="fa fa-plus-circle fa-lg"></i> Users List
                                    </a>
                                    <a href="user_add.php" class="btn btn-primary">
                                        <i class="fa fa-plus-circle fa-lg"></i> Add New user
                                    </a>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-box clearfix">
                                        <div class="table-responsive">
                                            <table class="table user-list">
                                                <thead>
                                                    <tr>
                                                        <th><span>User</span></th>
                                                        <th><span>Created Date</span></th>
                                                        <th class="text-center"><span>Status</span></th>
                                                        <th><span>Email</span></th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                        <?php
                                                    
                                                    foreach ($all_users as $v_user) {
                                                       
                                                        ?>
                                                        <tr>
                                                            <td>
                                                               <?php 
                                                                    $get_info_from_profile_by_user_id = $profileobj->get_info_from_profile_by_user_id($v_user['id']);
                                                                    
                                                               ?> 
                                                                <?php if (isset($get_info_from_profile_by_user_id['image']) && !empty($get_info_from_profile_by_user_id['image'])) { ?>
                                                                <img src="../img/profile_pics/<?php echo $get_info_from_profile_by_user_id['image']; ?>" width="50" height="50" alt="" class="profile-img img-responsive center-block"/>
                                                                <?php } else { ?>
                                                                    <img src="../img/samples/Unknown_Person.png" width="50" height="50" alt="" class="profile-img img-responsive center-block"/>

                                                                <?php } ?>
                                                                <a href="user_view.php?id=<?php echo $v_user['id'];?>" class="user-link">
                                                                    <?php 
                                                                        if($get_info_from_profile_by_user_id['firstname']){
                                                                            echo $get_info_from_profile_by_user_id['firstname'].' '.$get_info_from_profile_by_user_id['lastname'];
                                                                        }else{
                                                                         echo $v_user['username'] ;
                                                                        }
                                                                    ?>
                                                                </a>
                                                                <span class="user-subhead">
                                                                    <?php
                                                                    if ($v_user['is_admin'] == 1) {
                                                                        echo "Admin";
                                                                    } else {
                                                                        echo "User";
                                                                    }
                                                                    ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <?php echo $v_user['created_at']; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                    <?php
                                                                    if ($v_user['is_active'] == 1) { ?>
                                                                        <a href = "user_status.php?id=<?php echo $v_user['id'];?>">
                                                                        <span class = "label label-danger">Deactive</span>
                                                                        </a>
                                                                            <?php } else { ?>
                                                                <a href = "user_status_inactive.php?id=<?php echo $v_user['id']; ?>">
                                                                                    <span class = "label label-success">active</span>
                                                                                </a>
                                                                            <?php }  ?>
                                                                            
                                                            </td>
                                                            <td>
                                                                <a href="#"> <?php echo $v_user['email']; ?></a>
                                                            </td>
                                                            <td style="width: 20%;">
                                                                <a href="user_view.php?id=<?php echo $v_user['id'];?>" class="table-link">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                                </a>
                                                                <a href="user_edit.php?id=<?php echo $v_user['id'];?>" class="table-link">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                                </a>
                                                                <a href="user_restore.php?id=<?php echo $v_user['id'];?>" class="table-link" title="Restore">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                                </a>
                                                                <a href="user_delete.php?id=<?php echo $v_user['id'];?>" class="table-link danger">
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
                                        <ul class="pagination pull-right">
                                            <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
      <?php include_once 'admin_footer.php';?>
