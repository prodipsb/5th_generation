<?php
include_once '../vendor/autoload.php';

use App\Sliders;

$sliderobj = new Sliders;

$image_name = $_FILES['slider_image']['name'];
$image_type = $_FILES['slider_image']['type'];
$image_location = $_FILES['slider_image']['tmp_name'];
$image_size = $_FILES['slider_image']['size'];

$image = time().$image_name;

$m = explode('.', $image_name);
$exp = array_pop($m);
$image_type_support = array('jpg', 'jpeg', 'png','JPG','JPEG','gif', 'PNG');

if(in_array($exp, $image_type_support) === false){
    echo 'Invalid Format!';
}else{
    $_POST['slider_image'] = $image;
    $_POST['extention'] = $exp;
    $_POST['size'] = $image_size;
    move_uploaded_file($image_location, '../img/slides/'.$image);
}

$sliderobj->prepare_data($_POST);
$sliderobj->insert();

?>

