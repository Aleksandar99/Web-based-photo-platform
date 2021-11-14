<?php

if (!function_exists("rrmdir")) {
	/**
	 *
	 * Recursively delete directory
	 *
	 * @param $dir
	 * @param int $level // level 1 - keep root dir
	 * @return bool
	 */
	function rrmdir($dir, int $level=0): bool
	{
		if (!realpath($dir)) {
			return false;
		}

		$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator(
				$dir,
				RecursiveDirectoryIterator::SKIP_DOTS
			),
			RecursiveIteratorIterator::CHILD_FIRST
		);

		foreach ($files as $fileinfo) {
			$todo = $fileinfo->isDir() ? "rmdir" : "unlink";
			$todo($fileinfo->getRealPath());
		}

		if($level === 1){
			return true;
		}

		if (rmdir($dir)) {
			return true;
		}

		return false;
	}
}

function normalize_files_array(array $files = []) {

	$normalized_array = [];

	foreach($files as $index => $file) {

		if (!is_array($file['name'])) {
			$normalized_array[$index][] = $file;
			continue;
		}

		foreach($file['name'] as $idx => $name) {
			$normalized_array[$index][$idx] = [
				'name' => $name,
				'type' => $file['type'][$idx],
				'tmp_name' => $file['tmp_name'][$idx],
				'error' => $file['error'][$idx],
				'size' => $file['size'][$idx]
			];
		}

	}

	return $normalized_array;

}

function url($uri=''){
	$request_scheme = $_SERVER['REQUEST_SCHEME'] ?? "http";
	$base_url = $request_scheme . '://' . $_SERVER['HTTP_HOST'] .
		substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], basename($_SERVER['SCRIPT_FILENAME'])));

	return $base_url  . $uri;
}

function flash($name){
	$flash = '';
	if(isset($_SESSION['flash'][$name])){
		$flash = $_SESSION['flash'][$name];
		unset($_SESSION['flash'][$name]);
	}
	return $flash;
}
