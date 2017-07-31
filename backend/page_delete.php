<?php

include_once '../vendor/autoload.php';

use App\Articles;

$articleobj = new Articles();
$id = $_GET['id'];
$articleobj->article_delete($id);


