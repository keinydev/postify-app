<?php

class PostModel extends Model
{
	public $user;
	public $post;
	public $date; 

	public function __construct($data = [], UserModel $user = NULL)
	{ 
		$this->user = $user; 
		$this->post = isset($data['post']) ? trim(filter_var($data['post'], FILTER_SANITIZE_STRING)) : "";
		$this->date = date("Y-m-d"); 

		$this->setDataBaseFile("data.js");
	}

	/**
	 * This function add a new post to json file
	 */
	public function store()
	{
		$jsonData = $this->getAll();

	    $data = array(
			'username'=> $this->user->username,
			'post'=> $this->post,
			'date'=> $this->date,
	    );

		array_unshift($jsonData, $data);

		$this->save($jsonData);
	}

	/**
	 * This function get all the posts from the json file
	 * @return [array] Array with all the data
	 */
	public function getPosts()
	{
		$jsonData = $this->getAll();

		return $jsonData;
	}

	/**
	 * This function get the posts filtering by the parameters
	 * @param  [string] $search  Condition to filter
	 * @param  [string] $date    Date filter 
	 * @return [array] $posts array with post
	 */
	public function filterPost($search = '', $date = '')
	{
		$jsonData = $this->getPosts();

		$posts = array();

 		$posts = array_filter($jsonData, function ($item) use ($search, $date) {

		    if (stripos($item["post"], $search) !== false && ($item["date"] <= $date)) {
		        return true; echo "string1";
		    } 
		    else if(stripos($item["post"], $search) !== false && $item["date"] == ""){
		    	return true;echo "string";
		    } 
		    else if($item["date"] <= $date){
		    	return true;
		    }
		    return false;
		});

		return $posts;
	}	

}