<?php

class App
{
	protected $controllerName; 
	protected $modelName; 

	/**
	* This constructor allows the rounting using get parameters. 
	* load is used as a query parameter and you can find it in .htaccess file.
	* By default, when you open the app, the first page you see is from Home Controller
	* Finally, the class is instance at the end, executing the action specified
	*/
	public function __construct()
	{
		$this->controllerName = "Home";
		
		$action = "index";
		$query = null;
		$getLoad = isset($_GET['load']) ? $_GET['load'] : "";
		
		if ($getLoad)
		{
			$params = array();
			$params = explode("/", $getLoad);

			$this->controllerName = ucwords($params[0]);

			if (isset($params[1]) && !empty($params[1]))
			{
				$action = $params[1];
			}

			if (isset($params[2]) && !empty($params[2]))
			{
				$query = $params[2];
			}
		}
		
		$this->modelName = $this->controllerName;
		$this->controllerName .= 'Controller';

		if(!class_exists($this->controllerName))
		{
			$error = new ErrorController("Error", "index");
			$error->$action($query);
			return;
		}

		$load = new $this->controllerName($this->modelName, $action);

		if (method_exists($load, $action))
		{
			$load->$action($query);
		}
		else
		{
			die('Invalid method. Please check the URL.');
		}
	}
}