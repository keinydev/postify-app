<?php

class HomeController extends Controller
{
	/**
	* This function show the landing page 
	* @return The view of the method
	*/
	public function index()
	{
		$this->view->set('title', 'Home'); 
		return $this->view->output();
	}
}