<?php
include_once '../vendor/autoload.php';

use App\Users;

$userobj = new Users();
$id = $_GET['id'];
$userobj->status_update($id);
?>