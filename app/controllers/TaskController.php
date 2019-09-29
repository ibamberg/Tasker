<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Task;
use app\helper\Input;
use app\helper\Flash;
use app\core\App;

class TaskController extends Controller{

	public function actionIndex(){

		$task = new Task;

		$page = Input::get('page');
		$limit = Input::get('limit');

		$page = (is_numeric($page)) ? $page : 1;
		$limit = (is_numeric($limit)) ? $limit : 5;

		$isAdmin = App::$user->isAdmin();
		$isAuth = App::$user->isAuth();

		$offset = ($page - 1) * $limit; 
		$totalPages = ceil($task->getCount() / $limit);

		$tasks = $task->find()
			->orderBy("order by `id` DESC")
			->limit($limit)
			->offset($offset)
			->all();

		$pagination = $this->createPagination($page, $totalPages, $limit);
		$limitTab = $this->createLimitTab($limit);

		$this->render('index', [
			'limitTab' => $limitTab,
			'pagination' => $pagination,
			'tasks' => $tasks,
			'isAdmin' => $isAdmin,
			'isAuth' => $isAuth
		]);
	}

	public function actionCreate(){

		$task = new Task;

		$username = Input::post("username");
		$email = Input::post("email");
		$taskText = Input::post("taskText");

		if(Input::isSubmit()){
			if($username && $email && $taskText){
				$data = [
					'username' => $username,
					'email' => $email,
					'taskText' => $taskText
				];

				if($task->insert($data)){
					Flash::set('success', 'Task successfully added!');
					header("Location: /");
		    		exit;
		    	}else{
					Flash::set('danger', 'Failed to add task!');
				}
			}else{
				Flash::set('danger', 'All fields are required!');
			}
		}

		$this->render('create');
	}

	public function actionDelete(){

		$id = Input::get('id');

		$task = new Task;

		if(is_numeric($id) && App::$user->isAdmin()){

			if($task->deleteById($id) == 1){
				Flash::set('success', 'Task has been deleted!');
			}else{
				Flash::set('danger', 'Failed delete task!');
			}

			header("Location: /");
			exit;

		}

	}




	private function createLimitTab($limit){
		$limits = [1, 5, 10];

		$html .= '<nav class="nav"><span class="nav-link">Limit: </span>';

        foreach ($limits as $value) {
        	$class = ($value == $limit) ? 'disabled' : '';
        	$href = "/task?page=1&limit={$value}";

        	$html .= "<a class='nav-link {$class}' href='{$href}'>{$value}</a>";
        }

        $html .= '</nav>';

        return $html;
	}

	private function createPagination($page, $totalPages, $limit){
		if($totalPages > 0){
			$pagination = "<nav><ul class='pagination'>";
			
			if($page > 1) $pagination .= $this->createLink($page - 1, $limit, false, '<');
			if($page - 2 > 0) $pagination .= $this->createLink($page - 2, $limit);
			if($page - 1 > 0) $pagination .= $this->createLink($page - 1, $limit);
			$pagination .= $this->createLink($page, $limit, true);
			if($page + 1 < $totalPages + 1) $pagination .= $this->createLink($page + 1, $limit);
			if($page + 2 < $totalPages + 1) $pagination .= $this->createLink($page + 2, $limit);
			if($page < $totalPages) $pagination .= $this->createLink($page + 1, $limit, false, '>');

			$pagination .= "</ul></nav>";
		}

		return $pagination;
	}

	private function createLink($page, $limit, $isActive = false, $text = null){
		if(!$text) $text = $page;
		$active = ($isActive) ? 'active' : '';
		$href = "?page={$page}&limit={$limit}";

		return "<li class='page-item {$active}'><a class='page-link' href='/task{$href}'>$text</a></li>";
	}

}