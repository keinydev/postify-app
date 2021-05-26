<?php

class Model
{
	protected $db;
	protected $sql;

	public function __construct()
	{
		$this->db = 'data.js';
		$this->createFile(); 
	}

	/**
	* This function sets the name of the file to create. Finally, this file is created
	* @param [string] $file Filename 
	*/
	public function setDataBaseFile($file)
	{
		$this->db = $file;
		$this->createFile();
	}

	/**
	* This function writes data to a file
	* @param  [array] $data Array to save
	*/
	public function save($data)
	{
	    file_put_contents(DB_DIR . $this->db, json_encode($data, JSON_PRETTY_PRINT));
	}

	/**
	* This function gets all the data from the file
	* @return [type] [description]
	*/
	public function getAll()
	{
	    return json_decode(file_get_contents(DB_DIR . $this->db), true);
	}

	/**
	* Function to create the file and database folder in case this does not exist
	*/
	private function createFile()
	{
		if(!is_file(DB_DIR.$this->db))
		{
			if(!is_dir(DB_DIR))
			{
				$old = umask(0);
				mkdir(DB_DIR, 0777);
				umask($old);
			}

			$emptyJson = array();
			$this->save($emptyJson);
		} 
	}
}