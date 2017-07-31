<?php
include_once '../vendor/autoload.php';

use App\Profiles;

$profileobj = new Profiles();
$id = $_GET['id'];
$profileobj->status_update($id);
?>