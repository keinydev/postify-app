<?php

class View
{
	protected $file;
	protected $data = array();

	public function __construct($file)
	{
		$this->file = $file;
	}

	/**
	* This function sets a property to the controller using an array
	* @param [string] $key   Name of the property
	* @param [any]    $value Value of the property
	*/
	public function set($key, $value)
	{
		$this->data[$key] = $value; 
	}

	/**
	* This function gets a property to the controller using an array
	* @param  [string] $key   Name of the property 
	* @return [array]         Array with properties
	*/
	public function get($key)
	{
		return $this->data[$key];
	}

	/**
	* This function includes the file in order to show the view from the controller.
	* The $data variable is imported into the local symbol table
	* @param  [string] $key   Name of the property 
	* @return [array]         Array with properties
	*/
	public function output()
	{
		if (!file_exists($this->file))
		{
			throw new Exception("Template " . $this->file . " doesn't exist.");
		}

		extract($this->data);
		ob_start();
		include($this->file);
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
	}
}