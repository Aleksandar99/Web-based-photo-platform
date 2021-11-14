<?php

class View
{
	/**
	 * View constructor.
	 */
	public function __construct()
	{

	}

	public function render($view, $data = []): int
	{
		$viewPath = dirname(__DIR__) . DIRECTORY_SEPARATOR .'template'. DIRECTORY_SEPARATOR . $view . '.php';
		if(!file_exists($viewPath)){
			die('View (' . $viewPath . ') not found');
		}

		$main = $viewPath;

		ob_start();

		$countVariablesCreated = extract($data, EXTR_SKIP);
		if ($countVariablesCreated !== count($data)) {
			throw new \RuntimeException('Extraction failed: scope modification attempted');
		}

		include_once dirname(__DIR__) . DIRECTORY_SEPARATOR .'template'. DIRECTORY_SEPARATOR . 'layout.php';

		return print ob_get_clean();

	}
}
