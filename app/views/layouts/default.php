<?php
    use app\core\App;
    use app\helper\Flash;

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/awesome.min.css">
</head>
<body>
    <?php if($flash = Flash::get()) echo $flash; ?>
    <nav class="navbar navbar-light navbar-expand-sm bg-light justify-content-between">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/task/create/">Create new list of task</a>
            </li>
        </ul>
        <?php if(App::$user->isAuth()): ?>
            <a href="/user/logout/" class="btn btn-outline-primary">Logout</a>
        <?php else: ?>
            <a href="/user/login/" class="btn btn-outline-primary">Login</a>
        <?php endif; ?>
    </nav>
	
    <?=$content;?>

    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>