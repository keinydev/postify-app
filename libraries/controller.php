<?php

class Controller
{
	protected $model;
	protected $controller;
	protected $action;
	protected $view;
	protected $modelBaseName;

	public function __construct($model, $action)
	{
		$this->controller = ucwords(__CLASS__);
		$this->action = $action;
		$this->modelBaseName = $model;

		$this->view = new View(HOME . DS . 'views' . DS . strtolower($this->modelBaseName) . DS . $action . '.php');
	}

	/**
	* This function creates a new instance to the model 
	* @param [string] $modelName Model to instance
	*/
	protected function setModel($modelName)
	{
		$modelName .= 'Model';
		$this->model = new $modelName();
	}

	/**
	* This function creates a new instance to the View model in order to set a new view
	* @param [string] $viewName Model to instance
	*/
	protected function setView($viewName)
	{
		$this->view = new View(HOME . DS . 'views' . DS . strtolower($this->modelBaseName) . DS . $viewName . '.php');
	}

	/**
	* This function creates a "flash message" using sessions
	* @param [string] $message Message to show
	*/
	protected function setFlashMessage($message = '')
	{
		$_SESSION['notice'] = $message;
	}	

	/**
	* Function to validate the user session
	* @return [boolean] Validation of the session
	*/
	protected function isLogged()
	{
		return ($_SESSION['user'] ?? NULL !== NULL);
	}	
}