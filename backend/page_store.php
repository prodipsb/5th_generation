<?php
include_once '../vendor/autoload.php';

use App\Pages;

$pageobj = new Pages();

//echo '<pre>';
//print_r($_POST);
//
//print_r($_FILES);
//exit();

//$image_name = $_FILES['image_name']['name'];
//$image_type = $_FILES['image_name']['type'];
//$image_location = $_FILES['image_name']['tmp_name'];
//$image_size = $_FILES['image_name']['size'];
//
//$image = time().$image_name;

//$m = explode('.', $image_name);
//$exp = array_pop($m);
//$image_type_support = array('jpg', 'jpeg', 'png');
//
//if(in_array($exp, $image_type_support) === false){
//    echo 'Invalid Format!';
//}else{
//    $_POST['image_name'] = $image;
//    $_POST['extention'] = $exp;
//    $_POST['size'] = $image_size;
//    move_uploaded_file($image_location, '../img/page_feature_images/'.$image);
//}

//echo '<pre>';
//print_r($image);
//exit();


$pageobj->prepare_data($_POST);
$pageobj->insert();



?>
