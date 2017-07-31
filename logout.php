<?php
include_once 'vendor/autoload.php';

use App\Users;

$userobj = new Users();
$userobj->logout();

?>