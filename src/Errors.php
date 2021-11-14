<?php

class Errors
{
	public array $errors = [];

	/**
	 * Errors constructor.
	 * @param array $errors
	 */
	public function __construct()
	{

	}

	/**
	 * @return array
	 */
	public function getError($name): string
	{
		return $this->errors[$name];
	}

	public function getErrors()
	{
		return $this->errors;
	}

	public function hasErrors()
	{
		return !empty($this->errors);
	}

	/**
	 * @param $name
	 * @param $value
	 */
	public function setErrors($name, $value): void
	{
		$this->errors[$name] = $value;
	}

}
