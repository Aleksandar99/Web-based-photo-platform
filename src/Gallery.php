<?php


class Gallery
{
	public string $galleryName;

	public string $uploadsDirectory;

	public Errors $errors;

	/**
	 * @param string $galleryName
	 */
	public function __construct()
	{
		$this->uploadsDirectory = 'upload';
		$this->errors = new Errors();
	}

	/**
	 * @param $galleryName
	 * @return bool
	 */
	public function create($galleryName): bool
	{
		$this->galleryName = $galleryName;
		$directoryName = $this->uploadsDirectory . DIRECTORY_SEPARATOR . $this->galleryName;
		$thumbnailDir = $this->uploadsDirectory . DIRECTORY_SEPARATOR . $this->galleryName . DIRECTORY_SEPARATOR . 'thumbs';

		if (is_dir($directoryName)) {
			$this->errors->setErrors('gallery_error', 'Вече съществува галерия с това име');
			return false;
		}

		if (!mkdir($directoryName, 0777, true)
			&& !is_dir($directoryName)) {
			throw new RuntimeException(sprintf('Directory "%s" was not created', $directoryName));
		}
		if (!mkdir($thumbnailDir, 0777, true)
			&& !is_dir($thumbnailDir)) {
			throw new RuntimeException(sprintf('Directory "%s" was not created', $thumbnailDir));
		}
		return true;
	}

	/**
	 * @param string $galleryName
	 */
	public function setGallery(string $galleryName): void
	{
		$this->galleryName = $galleryName;
	}



	/**
	 * @param mixed $uploadsDirectory
	 */
	public function setUploadsDirectory($uploadsDirectory): void
	{
		$this->uploadsDirectory = $uploadsDirectory;
	}

	/**
	 * @return array
	 */
	public function getImages(): array
	{
		$dir = new DirectoryIterator($this->getFullDirectoryName());

		$images = [];

		foreach ($dir as $k => $fileinfo) {
			if (!$fileinfo->isDot() && !$fileinfo->isDir()) {
				$file = $this->getFullDirectoryName() . '/' . $fileinfo->getFilename();
				$images[$k]['img_path'] = $file;
				$images[$k]['img_name'] = $fileinfo->getFilename();

				$images[$k]['thumbs'] = $this->getFullDirectoryName() . "/thumbs/" . $fileinfo->getFilename();
				$images[$k]['info'] = getimagesize($file);
			}
		}

		return $images;
	}

	/**
	 * @return string
	 */
	public function getFullDirectoryName(): string
	{
		return $this->uploadsDirectory . '/' . $this->galleryName;
	}

	/**
	 * @param $galleryName
	 * @return bool
	 */
	public function galleryExist($galleryName): bool
	{
		$directoryName = $this->uploadsDirectory . DIRECTORY_SEPARATOR . $this->galleryName;
		return is_dir($directoryName);
	}

	/**
	 * @return array
	 */
	public function getGalleries(): array
	{
		$listDir = [];
		$dir = new DirectoryIterator($this->uploadsDirectory);
		foreach ($dir as $fileinfo) {
			if (!$fileinfo->isDot()) {
				$listDir[] = $fileinfo->getFilename();
			}
		}

		return $listDir;
	}

	public function countImages($gallery)
	{
		$i = 0;
		$dir = new DirectoryIterator($this->uploadsDirectory . DIRECTORY_SEPARATOR . $gallery );
		foreach ($dir as $fileinfo) {
			if (!$fileinfo->isDot()&&$fileinfo->isFile()) {
				$i++;
			}
		}
		return $i;
	}

	/**
	 * @param $image
	 * @return bool
	 */
	public function delete($image): bool
	{
		$file = $this->getFullDirectoryName() . DIRECTORY_SEPARATOR . $image;
		$thumb = $this->getFullDirectoryName() . DIRECTORY_SEPARATOR . "thumbs" . DIRECTORY_SEPARATOR . $image;

		return unlink($file) && unlink($thumb);
	}

	/**
	 * @param $gallery
	 * @return bool
	 */
	public function removeGallery($gallery): bool
	{
		return rrmdir($this->getFullDirectoryName());
	}

}
