<?php
include_once '../vendor/autoload.php';

use App\Profiles;

$profileobj = new Profiles();

$user_id = $_POST['user_id'];
$ckeck_user_id_in_profile = $profileobj->get_info_from_profile_by_user_id($user_id);
//echo '<pre>';
//print_r($_POST);
////exit();
//echo '<pre>';
//print_r($_FILES['image']);
//exit();

$image_name = $_FILES['image']['name'];
$image_type = $_FILES['image']['type'];
$image_location = $_FILES['image']['tmp_name'];
$image_size = $_FILES['image']['size'];
//$path = '../../../../img/profile_pics/';

$image = time().$image_name;

$m = explode('.', $image_name);
$exp = array_pop($m);
$image_type_support = array('jpg','JPG','jpeg', 'JPEG','png', 'gif');

if(in_array($exp, $image_type_support) === false){
    echo 'Invalid Format!';
}else{
    $_POST['image'] = $image;
    move_uploaded_file($image_location, '../img/profile_pics/'.$image);
}




$profileobj->prepare_data($_POST);
if(!empty($ckeck_user_id_in_profile)){
    $profileobj->update();
}else{
$profileobj->insert();
}

?>