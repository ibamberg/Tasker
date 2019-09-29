<?php

namespace app\models;

use app\core\Model;

class Task extends Model{

	public static function tableName()
	{
		return 'task';
	}

}