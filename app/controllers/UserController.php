<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;
use app\helper\Input;
use app\helper\Flash;
use app\core\App;
use app\helper\Redirect;

class UserController extends Controller{

	public function actionIndex(){

		$username = Input::post('email');
		$password = Input::post('password');

		if(App::$user->isAuth()){
			Redirect::goHome();
		}

		if($username && $password){
			if(App::$user->login($username, $password)){
				Redirect::goHome();
			}else{
				Flash::set('danger', 'Invalid login and/or password!');
			}
		}

		$this->render('login');
	}

	public function actionLogin(){
		$this->actionIndex();
	}

	public function actionLogout(){
		App::$user->logout();
		Redirect::goHome();
	}

}