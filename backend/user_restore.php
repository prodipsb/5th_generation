<?php
include_once '../vendor/autoload.php';

use App\Users;

$userobj = new Users();

$id = $_GET['id'];
$userobj->user_restore($id);

?>
