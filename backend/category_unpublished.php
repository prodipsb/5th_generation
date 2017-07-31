<?php

include_once '../vendor/autoload.php';

use App\Categories;

$categoryobj = new Categories();
$id = $_GET['id'];
$categoryobj->category_unpublished($id);

