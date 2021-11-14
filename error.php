<?php
include_once 'vendor/autoload.php';
$gallery = new Gallery();
$page = new View();

$page->render('error-page', ['gallery'=>$gallery]);
