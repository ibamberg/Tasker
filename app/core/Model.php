<?php

namespace app\core;

use app\core\DB;

class Model
{

	private $_db;
	
	function __construct()
	{
		$this->_db = new DB(static::tableName());
	}

	public function find(){
		return $this->_db->getSelect();
	}

	public function insert($fields){
		return $this->_db->insert($fields);
	}

	public function deleteById($id){
		return $this->_db->deleteById($id);
	}

	public function getCount(){
		return $this->_db->getCount();
	}
}