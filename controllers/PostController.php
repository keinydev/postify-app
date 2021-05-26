<?php

class PostController extends Controller
{
	private $user;

	public function __construct($model, $action)
	{
		parent::__construct($model, $action);

		if(!$this->isLogged()){
			 header('Location: /user/login');
		}

		$this->user = new UserModel();
		$this->user->getUserById($_SESSION['user'] ?? NULL); 

		$this->model = new PostModel();
	}

	/**
	* This function show the main view and get all the posts for printing purposes
	* @return The view of the method
	*/
	public function index()
	{
		$this->setView('index'); 
		$this->view->set('title', 'Post'); 
		$this->view->set('posts', $this->model->getPosts()); 
		$this->view->set('user', $this->user->username);
		return $this->view->output();
	}

	/**
	* This function instance the model in order to send the data and save it
	* @return Redirect to the same page with or without errors
	*/
	public function create()
	{
		if (!isset($_POST['submitPost']))
		{
			header('Location: /post/index');
		}

		$this->model = new PostModel($_POST, $this->user);

		$errors = $this->dataValidation();

		if (count($errors) > 0)
		{
			$this->setView('index'); 
			$this->view->set('title', 'Post'); 
			$this->view->set('errors', $errors);
			$this->view->set('formData', $_POST);
			$this->view->set('posts', $this->model->getPosts()); 
			return $this->view->output();
		}

		try {

			$this->model->store();

		} catch (Exception $e) {
			$this->view->set('title', 'There was an error saving the data!');
			$this->view->set('formData', $_POST);
			$this->view->set('saveError', $e->getMessage());
		}
		 
		header('Location: /post/index');
	}

	/**
	* This function filter all the post using the formulary filters
	* @return Redirect to the same page with data
	*/
	public function filter()
	{
		if (!isset($_POST['searchFilter']) || !isset($_POST['dateFilter']) || !isset($_POST['submitFilter']))
		{
			header('Location: /post/index');
		}

		$search = isset($_POST['searchFilter']) ? filter_var($_POST['searchFilter'], FILTER_SANITIZE_STRING) : '';
		$date = isset($_POST['dateFilter']) ? filter_var($_POST['dateFilter'], FILTER_SANITIZE_STRING) : '';

		$posts = $this->model->filterPost($search, $date);
		
		$this->setView('index'); 
		$this->view->set('title', 'Post'); 
		$this->view->set('formData', $_POST);
		$this->view->set('posts', $posts); 
		return $this->view->output();
	}	

	/**
	* This function validates data in order to save the form
	* @return [array] errors
	*/
	private function dataValidation()
	{
		$errors = array();

		if(empty($this->model->post)){
			$errors["post"] =  "This field is required";
		}

		return $errors;
	}
}