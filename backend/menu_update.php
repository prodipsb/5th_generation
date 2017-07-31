<?php
include_once '../vendor/autoload.php';

use App\Menus;

$menuobj = new Menus();

//echo '<pre>';
//print_r($_POST);
//exit();

$menuobj->prepare_data($_POST);
$menuobj->update();


?>