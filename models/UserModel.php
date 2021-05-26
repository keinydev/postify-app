<?php

class UserModel extends Model
{
	public $id;
	public $username;
	public $email;
	public $phone;
	public $password; 

	public function __construct($data = [])
	{ 
		$this->id = isset($data['id']) ? trim($data['id']) : "";
		$this->username = isset($data['username']) ? trim($data['username']) : "";
		$this->phone = isset($data['phone']) ? trim($data['phone']) : "";
		$this->email = isset($data['email']) ? trim($data['email']) : "";
		$this->password = isset($data['password']) ? trim($data['password']) : "";
 
		$this->setDataBaseFile("user.js");
	}

	/**
	 * This function save the new user in a json file
	 */
	public function store()
	{
		$jsonData = $this->getAll();
		
		$this->id = uniqid();

	    $data = array(
			'id'=> $this->id,
			'username'=> $this->username,
			'phone'=> $this->phone,
			'email'=> $this->email,
			'password'=> $this->password,
	    );

		$jsonData[] = $data;

		$this->save($jsonData);
	}

	/**
	 * This function get the user using the id condition. 
	 * @param  [integer] $id  User id 
	 * @return [array] User array
	 */
	public function getUserById($id)
	{
		$jsonData = $this->getAll();

		foreach ($jsonData as $obj){
		    if ($obj["id"] == $id) {

				$this->id = $obj['id'];
				$this->username = $obj['username'];
				$this->phone = $obj['phone'];
				$this->email = $obj['email'];
				$this->password = $obj['password'];

		        return $obj;
		    }
		}
	}

	/**
	* Function to check if the user exists in the json file 
	* @return [boolean, array] 
	*/
	public function checkLogin()
	{
		$jsonData = $this->getAll();

		foreach ($jsonData as $obj){
		    if ($obj["username"] == $this->username && $obj["password"] == $this->password) {
		        return $obj;
		    }
		}

		return false;
	}
}