<?php

class UserController extends Controller
{
	public function __construct($model, $action)
	{
		parent::__construct($model, $action);
		$this->setModel($model);

		if($this->isLogged()){
			header('Location: /post/index');
		}
	}

	/**
	* This function show the signup page using "new" view
	* @return The view of the method
	*/
	public function signup()
	{
		$this->setView('new');
		$this->view->set('title', 'Create an account'); 
		return $this->view->output();
	}

	/**
	* This function instance the model in order to send the data and save it
	* @return Redirection to post page or redirection to signup page with errors
	*/
	public function create()
	{
		if (!isset($_POST['signUpForm']))
		{
			header('Location: /user/signup');
		}
		
		$this->model = new UserModel($_POST);
		$this->setView('new');

		$errors = $this->dataValidation();

		if (count($errors) > 0)
		{
			$this->setView('new'); 
			$this->view->set('title', 'Create an account');
			$this->view->set('errors', $errors);
			$this->view->set('formData', $_POST);
			return $this->view->output();
		}

		try {

			$this->model->store();

			$this->createSession($this->model->id);

			$this->setFlashMessage("Welcome for the first time!"); 

		} catch (Exception $e) {
			$this->view->set('title', 'There was an error saving the data!');
			$this->view->set('formData', $_POST);
			$this->view->set('saveError', $e->getMessage());
		}
		 
		header('Location: /post/index');
	}

	/**
	* This function show the login page using "login" view
	* @return The view of the method
	*/
	public function login()
	{
		$this->setView('login'); 
		$this->view->set('title', 'Login'); 
		return $this->view->output();
	}

	/**
	* Function to authenticate the user checking his existance in the database
	* @return Redirection to post page or redirection to login page with errors
	*/
	public function auth()
	{
		if (!isset($_POST['loginForm']))
		{
			header('Location: /user/login');
		}
		
		$this->model = new UserModel($_POST);

		$login = $this->model->checkLogin();

		if(!$login)
		{
			$this->setView('login'); 
			$this->view->set('title', 'Login');
			$this->view->set('error', 'Invalid');
			return $this->view->output();			
		}

		$this->setFlashMessage("Welcome again!"); 
		$this->createSession($login["id"]);

		header('Location: /post/index');
	}	

	/**
	* This function destroy the current session
	* @return Redirection to login page
	*/
	public function logout()
	{
		if($_SESSION['user'] === NULL){
			header('Location: /home/index');
		}

		$this->setFlashMessage("I hope to see you soon!"); 
		$this->destroySession();

		header('Location: /user/login');
	}	

	/**
	* This function validates data in order to save the form
	* @return [array] errors
	*/
	private function dataValidation()
	{
		$errors = array();

		$required = ["username", "phone", "email", "password"];

		for ($i=0; $i < count($required); $i++) 
		{ 
			$variable = $required[$i];

			if(empty($this->model->$variable)){
				$errors[$variable] =  "This field is required";
			}
		}


		if(!preg_match('/^[a-zA-Z]{4,}\d{2,}\z/', $this->model->username)){
			$errors["username"] =  "It should have at least 4 letters and 2 numbers, and should not contain special characters";
		}

		if (!filter_var($this->model->email, FILTER_VALIDATE_EMAIL))
		{ 
			$errors["email"] =  "It must be a valid email example@email.com";
		}

		if(!preg_match('/^[0-9]{10,}\z/', $this->model->phone)){
			$errors["phone"] =  "It should have at least 10 numbers";
		}

		if(!preg_match('/^(?=.*[A-Z])(?=.*[-]).{6,}$/', $this->model->password)){
			$errors["password"] =  "It should be at least 6 characters long and contain a '-' and an uppercase letter";
		}

		return $errors;
	}

	/**
	* Function to create a session when the user is created or is logged in
	* @param  [integer] $id User id 
	*/
	private function createSession($id)
	{
		$_SESSION['active'] = true;
		$_SESSION['user'] = $id; 
	}

	/**
	* Function to destroy a session when the user has logged out
	*/
	private function destroySession()
	{
		$_SESSION['active'] = false;
		$_SESSION['user'] = NULL;
	}	
}