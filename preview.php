<?php
include_once 'vendor/autoload.php';
$galleryName = $_GET['gallery'] ?? '';
$gallery = new Gallery();

if ($galleryName) {
	$gallery->galleryName = $galleryName;
}

$page = new View();

//$page->render('header', ['gallery'=>$gallery, 'galleryName'=>$galleryName]);
$page->render('preview-gallery',  ['gallery'=>$gallery, 'galleryName'=>$galleryName]);
//$page->render('footer');
