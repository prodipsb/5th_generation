<?php
include_once '../vendor/autoload.php';

use App\Categories;

$categoryobj = new Categories();

echo '<pre>';
print_r($_POST);
//exit();

$categoryobj->prepare_data($_POST);
$categoryobj->insert();

?>
