<?php
include_once '../vendor/autoload.php';

use App\Menus;

$menuobj = new Menus();
$menuobj->prepare_data($_POST);

if (isset($_POST['id']) && !empty($_POST['id'])){
    $menuobj->update();
} else {
    $menuobj->insert();
}


//echo '<pre>';
//print_r($menus_info);
//exit();
?>