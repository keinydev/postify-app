<?php

session_start();  

define ('DS', DIRECTORY_SEPARATOR);
define ('HOME', dirname(__FILE__));
define ('DB_NAME', '');
define ('VIEWS_LAYOUT', HOME . DS . 'views' . DS . 'layout' . DS);
define ('PUBLIC_DIR', DS . 'public' . DS);
define ('DB_DIR', HOME . DS . 'database'. DS);
ini_set ('display_errors', 1);

spl_autoload_register(function ($class) {

	if (file_exists(HOME . DS . 'libraries' . DS . strtolower($class) . '.php'))
	{
		require_once HOME . DS . 'libraries' . DS . strtolower($class) . '.php';
	}
	else if (file_exists(HOME . DS . 'models' . DS . strtolower($class) . '.php'))
	{
		require_once HOME . DS . 'models' . DS . strtolower($class) . '.php';
	}
	else if (file_exists(HOME . DS . 'controllers' . DS . strtolower($class) . '.php'))
	{
		require_once HOME . DS . 'controllers'  . DS . strtolower($class) . '.php';
	} 
});

require_once HOME . DS . 'libraries' . DS . 'routing.php';

$App = new App();