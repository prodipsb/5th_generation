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
                                            <div class="form-group">
                                                <label for="firstname">First Name</label>
                                                <input type="text" name="firstname" class="form-control"
                                                       value="<?php if(isset($user_profile_info['firstname'])){
                                                           echo $user_profile_info['firstname'];
                                                       }else{
                                                           echo '';
                                                       }?>"
                                                       id="firstname" placeholder="First Name">
                                                <input type="hidden" name="user_id" value="<?php echo $user_info['id'];?>" class="form-control" id="user_id">
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Last Name</label>
                                                <input type="text" name="lastname"
                                                       value="<?php if(isset($user_profile_info['lastname'])){
                                                           echo $user_profile_info['lastname'];
                                                       }else{
                                                           echo '';
                                                       }?>"
                                                       class="form-control" id="lastname" placeholder="Last Name">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="gender">Gender</label><br>
                                                <input type="radio" name="gender" value="Male" <?php if($user_profile_info['gender'] == 'Male'){echo 'checked';}?> id="gender"> Male  
                                                <input type="radio" name="gender" value="Female" <?php if($user_profile_info['gender'] == 'Female'){echo 'checked';}?> id="gender"> Female
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile_no">Mobile Number</label>
                                                <input type="text" name="mobile_no"
                                                       value="<?php if(isset($user_profile_info['mobile_no'])){
                                                           echo $user_profile_info['mobile_no'];
                                                       }else{
                                                           echo '';
                                                       }?>"
                                                       class="form-control" id="mobile_no" placeholder="Mobile Number">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea name="address" class="form-control" id="address" rows="3" style="text-align: left;">
                                                    <?php if(isset($user_profile_info['address'])){
                                                           echo $user_profile_info['address'];
                                                       }else{
                                                           echo '';
                                                       }?>
                                                </textarea>
                                            </div>

                                           
                                            <div class="form-group form-group-select2">
                                                <label>Select Country</label>
                                                <select name="country" style="width:300px" id="sel2">
                                                    
                                                    <option value="Bangladesh" <?php if($user_profile_info['country'] == 'Bangladesh'){echo 'selected';}?>>Bangladesh</option> 
                                                    <option value="India" <?php if($user_profile_info['country'] == 'India'){echo 'selected';}?>>India</option> 
                                                    <option value="Sri-Lanka" <?php if($user_profile_info['country'] == 'Sri-Lanka'){echo 'selected';}?>>Sri-Lanka</option> 
                                                    <option value="Nepal" <?php if($user_profile_info['country'] == 'Nepal'){echo 'selected';}?>>Nepal</option> 
                                                    <option value="Mexico" <?php if($user_profile_info['country'] == 'Mexico'){echo 'selected';}?>>Mexico</option> 
                                                    <option value="Brazil" <?php if($user_profile_info['country'] == 'Brazil'){echo 'selected';}?>>Brazil</option> 
                                                    <option value="United States" <?php if($user_profile_info['country'] == 'United States'){echo 'selected';}?>>United States</option> 
                                                    <option value="United Kingdom" <?php if($user_profile_info['country'] == 'United Kingdom'){echo 'selected';}?>>United Kingdom</option> 
                                                    
                                                    
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Profile Picture</label>
                                                <input type="file" name="image" class="form-control" id="image">
                                                <?php if(isset($user_profile_info['image'])){?>
                                                    <img src="<?php  echo '../img/profile_pics/'.$user_profile_info['image']; ?>" alt="" width="200" height="200">
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