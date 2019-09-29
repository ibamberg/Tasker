<?php

namespace app\models;

use app\core\Model;
use app\helper\Session;

class User extends Model{

	private $_prefix = "tasker_";
	public $username = '';

	public static function tableName()
	{
		return 'user';
	}

	public function getUserByName($username){

		return $this->find()->Where(['username' => $username])->one();

	}

	public function login($username, $password){

		if(Session::get('isLogged')){
			return true;
		}

		if($user = $this->getUserByName($username)){
			if(password_verify($this->_prefix . $password, $user['password'])){
				Session::set('user', ['username' => $username]);
				Session::set('isLogged', true);
				return true;
			}

		}

		return false;
	}

	public function isAdmin(){
		if ($user = $this->getUserByName(Session::get('user')['username'])){
			if($user['isAdmin'] == 1){
				return true;
			}
		}

		return false;
	}

	public function isAuth(){
		return Session::get('isLogged');
	}

	public function logout(){
		Session::destroy();
	}

}