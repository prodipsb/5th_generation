<?php
include_once '../vendor/autoload.php';

use App\Profiles;
use App\Users;

$userobj = new Users();
$profileobj = new Profiles();

$id = $_GET['id'];
$user_info = $userobj->view_user($id);
$user_profile_info = $profileobj->view_user_details($id);
//echo '<pre>';
//print_r($user_info);
//exit();

?>
        <?php include_once 'admin_header.php';?>
                <div class="col-md-10" id="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                         
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="main-box">
                                        <h2>Edit Profile</h2>
                                        <form action="user_store.php" method="POST" >
                                            
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" class="form-control" id="username" placeholder="User Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Password</label>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                                            </div>
                                           
                                           
                                           
                                            <input type="submit" value="Save">
                                            <input type="reset"  value="Reset">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                   
                                </div>	
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
      <?php include_once 'admin_footer.php';?>