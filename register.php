<?php
include_once 'vendor/autoload.php';

use App\Users;

$userobj = new Users();
$userobj->prepare_data($_POST);
$request = $userobj->reg_check();
if ($request == "Success"){
    $userobj->insert();
}else{
    header('location:login.php#tologin');
}





