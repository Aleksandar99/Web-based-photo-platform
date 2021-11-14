<?php

class ImageResize
{
	private $image_type;

	private $image;

	public function __construct()
	{
	}

	/**
	 * @param $filename
	 * @return $this
	 */
	public function getImage($filename)
	{
		$image_info = getimagesize($filename);
		$this->image_type = $image_info[2];
		if ($this->image_type === IMAGETYPE_JPEG) {

			$this->image = imagecreatefromjpeg($filename);
		} elseif ($this->image_type === IMAGETYPE_GIF) {

			$this->image = imagecreatefromgif($filename);
		} elseif ($this->image_type === IMAGETYPE_PNG) {

			$this->image = imagecreatefrompng($filename);
		}
		return $this;
	}

	/**
	 * @param $width
	 * @param $height
	 * @param int $mode
	 * @return $this
	 */
	public function resize($width, $height, $mode = IMG_BILINEAR_FIXED)
	{
		$this->image = imagescale($this->image, $width, $height, $mode);
		return $this;
	}

	/**
	 * @param $filename
	 * @param int $compression
	 * @param null $permissions
	 */
	public function save($filename, $compression = 75)
	{
		$image_type = $this->image_type;

		if ($image_type === IMAGETYPE_JPEG) {
			imagejpeg($this->image, $filename, $compression);

		} elseif ($image_type === IMAGETYPE_GIF) {
			imagegif($this->image, $filename);

		} elseif ($image_type === IMAGETYPE_PNG) {
			imagepng($this->image, $filename);
		}
	}
}
