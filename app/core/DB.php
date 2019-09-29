<?php

namespace app\core;

use PDO;
use PDOException;
use app\helper\Config;
use app\core\Select;

class DB
{

	private $_PDO;
	private $_tableName;

	function __construct($tableName)
	{
		try{
			$config = Config::get()['db'];
			$this->_PDO = new PDO($config['dsn'], $config['username'], $config['password']);
			$this->_tableName = $tableName;
			
		}catch(PDOException $ex){
			die($ex->getMessage());
		}
	}

	public function getSelect(){
		return new Select($this->_PDO, $this->_tableName);
	}

	public function getCount(){
		$sql = "SELECT COUNT(*) FROM `{$this->_tableName}`";
		return $this->query($this->_PDO, $sql)[0]["COUNT(*)"];
	}

	public function deleteById($id){
		if(is_numeric($id)){
			$sql = "DELETE FROM `{$this->_tableName}` WHERE `id` = :id";
			$params[':id'] = $id;
			return $this->query($this->_PDO, $sql, $params);
		}
		return false;
	}

	public function insert($fields){

		if(count($fields)){

			$params = [];
            foreach ($fields as $key => $value) {
                $params[":{$key}"] = $value;
            }

            $columns = implode("`, `", array_keys($fields));
            $values = implode(", ", array_keys($params));

            $sql = "INSERT INTO `{$this->_tableName}` (`{$columns}`) VALUES ({$values})";

            if($this->query($this->_PDO, $sql, $params)) 
            	return($this->_PDO->lastInsertId());
            else 
            	return false;
            
		}

	}

	public static function query($pdo, $sql, $params = []){

		if($query = $pdo->prepare($sql)){

			foreach ($params as $key => $value){ 
				$dataType = (is_int($value)) ? PDO::PARAM_INT : PDO::PARAM_STR;
				$query->bindValue($key, $value, $dataType);
			}

			if($query->execute()){
				$rowCount = $query->rowCount();
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				if(count($result) == '0') $result = $pdo->lastInsertId();
				if($result == '0') $result = $rowCount;
				return $result;
			}


		}

		return false;
	}
}