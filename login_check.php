<?php
include_once 'vendor/autoload.php';

use App\Users;

$userobj = new Users();
$userobj->prepare_data($_POST);
$userobj->login_check();

?>