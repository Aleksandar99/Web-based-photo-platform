<?php

require 'vendor/autoload.php';

$gallery = new Gallery();
$gallery->setGallery($_POST['gallery']);

if($gallery->removeGallery($_POST['gallery'])){
	echo json_encode(['s'=>'success']);
	exit;
}

echo json_encode(['s'=>'error']);
exit;
