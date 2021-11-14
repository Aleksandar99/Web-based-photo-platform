<?php
session_start();
require 'vendor/autoload.php';
if (function_exists('exif_imagetype') === false) {
	$_SESSION['flash']['error'] = ['Липсващо PHP разширение - ( extension=exif )'];
	header("Location:" . url('error.php'));
	exit;
}
$allowedTypes = [1, 2, 3];
$phpFileUploadErrors = [
	0 => 'There is no error, the file uploaded with success',
	1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
	2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
	3 => 'The uploaded file was only partially uploaded',
	4 => 'No file was uploaded',
	6 => 'Missing a temporary folder',
	7 => 'Failed to write file to disk.',
	8 => 'A PHP extension stopped the file upload.',
];

define('UPLOAD_ERR_UNKNOWN', 'The files was not uploaded due to an unknown error.');

$errors = new Errors();

$files = normalize_files_array($_FILES);
$uploadMaxSize = 5;//ini_get('upload_max_filesize');
$maxFileUploads = 10;

if (!$_POST['gallery']) {
	$_SESSION['flash']['error'] = ['Въведете име на галерията!'];
	header("Location:" . url('error.php'));
	exit;
}

if (count($files['files']) > $maxFileUploads) {
	$_SESSION['flash']['error'] = ['Не може да качите повече от ' . $maxFileUploads . ' файла едновременно'];
	header("Location:" . url('error.php'));
	exit;
}

foreach ($files['files'] as $k => $v) {
	if (round($v['size'] / 1048576, 2) > $uploadMaxSize) {
		$errors->setErrors($v['name'], 'Файлът ' . $v['name'] . ' е по-голям от ' . $uploadMaxSize . 'MB');
	}
}

if ($errors->hasErrors()) {
	$_SESSION['flash']['error'] = $errors->getErrors();
	header("Location:" . url('error.php'));
	exit;
}

$gallery = new Gallery();
$gallery->setUploadsDirectory('upload');
$galleryName = $_POST['gallery'] ?? $_POST['add-gallery'];

if (isset($_POST['gallery']) && $gallery->create($_POST['gallery']) === false) {
	$_SESSION['flash']['error'] = [$gallery->errors->getError('gallery_error')];
	header("Location:" . url('error.php'));
	exit;
}

if (isset($_POST['add-gallery'])) {
	$gallery->setGallery($_POST['add-gallery']);
}

$img = new ImageResize();

foreach ($files['files'] as $file) {
	$fileName = $gallery->getFullDirectoryName() . DIRECTORY_SEPARATOR . $file['name'];
	$fileThumb = $gallery->getFullDirectoryName() . DIRECTORY_SEPARATOR . "thumbs/" . $file['name'];

	if ($file['error'] !== 0) {
		$_SESSION['flash']['error'] = [$phpFileUploadErrors[$file['error']]];
		header("Location:" . url('error.php'));
		exit;
	}

	if (!in_array(exif_imagetype($file['tmp_name']), $allowedTypes, true)) {
		$_SESSION['flash']['error'] = ['неразрешен файлов тип'];
		header("Location:" . url('error.php'));
		exit;
	}

	$img->getImage($file['tmp_name'])
		->resize(240, 240)
		->save($fileThumb);

	if (!move_uploaded_file($file['tmp_name'], $fileName)) {
		$_SESSION['flash']['error'] = [UPLOAD_ERR_UNKNOWN];
		header("Location:" . url('error.php'));
		exit;
	}
}

header("Location:" . url('preview.php?gallery=' . $galleryName));
exit;
