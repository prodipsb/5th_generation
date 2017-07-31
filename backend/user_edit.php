<?php
include_once '../vendor/autoload.php';

use App\Profiles;
use App\Users;

$userobj = new Users();
$profileobj = new Profiles();

$id = $_GET['id'];
$user_info = $userobj->view_user($id);
//$user_profile_single_view = $profileobj->view_user_details($id);
$user_profile_single_view = $profileobj->single_user_edit($id);
//echo '<pre>';
//print_r($user_profile_single_view['user_id']);
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

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-box">
                                        <h2>Edit Profile</h2>
                                        <form action="profile_store.php" method="POST" enctype="multipart/form-data">
                                           
                                            <input type="hidden" name="user_id" value="<?php echo $user_info['id'];?>">
                                            <div class="form-group">
                                                <label for="firstname">First Name</label>
                                                <input type="text" name="firstname" class="form-control"
                                                       value="<?php if(isset($user_profile_single_view['firstname'])){
                                                           echo $user_profile_single_view['firstname'];
                                                       }else{
                                                           echo '';
                                                       }?>"
                                                       id="firstname" placeholder="First Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Last Name</label>
                                                <input type="text" name="lastname"
                                                       value="<?php if(isset($user_profile_single_view['lastname'])){
                                                           echo $user_profile_single_view['lastname'];
                                                       }else{
                                                           echo '';
                                                       }?>"
                                                       class="form-control" id="lastname" placeholder="Last Name">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="gender">Gender</label><br>
                                                <input type="radio" name="gender" value="Male" <?php if($user_profile_single_view['gender'] == 'Male'){echo 'checked';}?> id="gender"> Male  
                                                <input type="radio" name="gender" value="Female" <?php if($user_profile_single_view['gender'] == 'Female'){echo 'checked';}?> id="gender"> Female
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile_no">Mobile Number</label>
                                                <input type="text" name="mobile_no"
                                                       value="<?php if(isset($user_profile_single_view['mobile_no'])){
                                                           echo $user_profile_single_view['mobile_no'];
                                                       }else{
                                                           echo '';
                                                       }?>"
                                                       class="form-control" id="mobile_no" placeholder="Mobile Number">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea name="address" class="form-control" id="address" rows="3">
                                                    <?php if(isset($user_profile_single_view['address'])){
                                                           echo $user_profile_single_view['address'];
                                                       }else{
                                                           echo '';
                                                       }?>
                                                </textarea>
                                            </div>

                                           
                                            <div class="form-group form-group-select2">
                                                <label>Select Country</label>
                                                <select name="country" style="width:300px" id="sel2">
                                                    <option value="United States" <?php if($user_profile_single_view['country'] == 'United States'){echo 'selected';}?>>United States</option> 
                                                    <option value="United Kingdom" <?php if($user_profile_single_view['country'] == 'United Kingdom'){echo 'selected';}?>>United Kingdom</option> 
                                                    <option value="Afghanistan" <?php if($user_profile_single_view['country'] == 'Afghanistan'){echo 'selected';}?>>Afghanistan</option> 
                                                    <option value="Albania" <?php if($user_profile_single_view['country'] == 'Albania'){echo 'selected';}?>>Albania</option> 
                                                    <option value="Algeria" <?php if($user_profile_single_view['country'] == 'Algeria'){echo 'selected';}?>>Algeria</option> 
                                                    <option value="American Samoa" <?php if($user_profile_single_view['country'] == 'American Samoa'){echo 'selected';}?>>American Samoa</option> 
                                                    <option value="Andorra" <?php if($user_profile_single_view['country'] == 'Andorra'){echo 'selected';}?>>Andorra</option> 
                                                    <option value="Bangladesh" <?php if($user_profile_single_view['country'] == 'Bangladesh'){echo 'selected';}?>>Bangladesh</option> 
                                                    
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Profile Picture</label>
                                                <input type="file" name="image" class="form-control" id="image">
                                                <?php if(isset($user_profile_single_view['image'])){?>
                                                    <img src="<?php  echo '../img/profile_pics/'.$user_profile_single_view['image']; ?>" alt="" width="200" height="">
                                              <?php  }?>
                                                
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