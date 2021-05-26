<?php

class ErrorController extends Controller
{
	/**
	* This function show the error page 
	* @return The view of the method
	*/
	public function index()
	{
		$this->setView('404'); 
		return $this->view->output();
	}
}