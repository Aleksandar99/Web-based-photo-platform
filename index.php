<?php
include_once 'vendor/autoload.php';
if (version_compare(PHP_VERSION, '7.4') < 0) {
	die('PHP version is less than the required 7.4 or more');
}
$gallery = new Gallery();
$page = new View();

$page->render('new-gallery', ['gallery'=>$gallery]);
