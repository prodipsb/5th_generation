<?php

include_once '../vendor/autoload.php';

use App\Sliders;

$sliderobj = new Sliders();
$id = $_GET['id'];
$sliderobj->slider_unpublished($id);

