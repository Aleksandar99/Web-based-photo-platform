<?php

require 'vendor/autoload.php';

$gallery = new Gallery();
$gallery->galleryName = $_POST['gallery'];
$file = $_POST['file'];

if($gallery->delete($file)){
	echo json_encode(['s'=>'success']);
	exit;
}
echo json_encode(['s'=>'error']);
exit;
