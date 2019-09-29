<?php

namespace app\core;

use PDO;
use app\core;
use app\core\DB;

class Select{

	private $_limit = '';
	private $_offset = '';
	private $_orderBy = '';
	private $_where = '';
	private $_params = [];
	private $_tableName;
	private $_PDO;

	function __construct($PDO, $tableName){
		$this->_PDO = $PDO;
		$this->_tableName = $tableName;
	}

	public function where($condition){
		$formatedCondition = $this->buildCondition($condition);
		if($formatedCondition != '') $this->_where = ' WHERE ' . $formatedCondition;
		return $this;
	}

	public function andWhere($condition){
		if($this->_where == ''){
			$this->where($condition);
		}else{
			$formatedCondition = $this->buildCondition($condition);
			if($formatedCondition != '') $this->_where = $this->_where . ' AND ' . $formatedCondition;
		}

		return $this;
	}

	public function limit($num){
		$num = (int)$num;
		if(is_int($num)){
			$this->_limit = " LIMIT :limit";
			$this->_params[":limit"] = $num; 
		}
		return $this;
	}

	public function offset($num){
		$num = (int)$num;
		if($this->_limit != '' && is_int($num) && $num != 0){
			$this->_offset = " OFFSET :offset";
			$this->_params[":offset"] = $num;
		}
		return $this;
	}

	public function orderBy($order){
		$this->_orderBy = $order;

		return $this;
	}

	public function one(){

		$this->limit(1);

		$sql = "SELECT * FROM `{$this->_tableName}`" 
			. $this->_where . $this->_limit . $this->_offset;

		$result = DB::query($this->_PDO, $sql, $this->_params)[0];

		return ($result == "0") ? false : $result;
	}

	public function all(){
		$sql = "SELECT * FROM `{$this->_tableName}`" 
			. $this->_where . $this->_orderBy
			. $this->_limit . $this->_offset;

		return DB::query($this->_PDO, $sql, $this->_params);
	}

	private function buildCondition($condition){

		$where = '';
		$conditionCount = count($condition);
		
		if($conditionCount == 1){
			foreach ($condition as $key => $value) {
				$where = "`{$key}` = '{$value}'";
			}
		}elseif($conditionCount == 3){
			if (in_array($condition[0], ["=", ">", "<", ">=", "<="])) {
				$where = "`{$operator[1]}` {$condition[0]} '{$operator[2]}'";
			}
		}

		return $where;
	}
}