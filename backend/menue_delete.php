<?php
include_once '../vendor/autoload.php';

use App\Menus;

$menuobj = new Menus();
$id = $_GET['id'];
$menuobj->delete($id);


?>
