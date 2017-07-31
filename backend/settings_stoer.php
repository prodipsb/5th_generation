<?php
include_once '../vendor/autoload.php';

use App\Settings;
$settingobj = new Settings();


$image_name = $_FILES['logo']['name'];
$image_type = $_FILES['logo']['type'];
$image_location = $_FILES['logo']['tmp_name'];
$image_size = $_FILES['logo']['size'];




$m = explode('.', $image_name);
$file_ext = strtolower(end($m));
$image = "logo.".$file_ext;

//print_r($_POST);
//die();

$image_type_support = array('jpg', 'jpeg', 'png','JPG','JPEG','gif', 'PNG');

if(in_array($file_ext, $image_type_support) === false){
    echo 'Invalid Format!';
    header('lcoation:settings.php');
}else{
    if(isset($_POST['oldimage']) && !empty($_POST['oldimage'])){
        //unlink("../img/logos/".$_POST['oldimage']);
    }
    $_POST['logo'] = $image;
    move_uploaded_file($image_location, '../img/logos/'.$image);

}

$settingobj->prepare($_POST);
$settingobj->update($_POST);
?>