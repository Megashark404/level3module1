<?php 

//var_dump($_SERVER['REQUEST_URI']);die;

$config = include 'config.php';

$routes = [
	'/marlin/level3/' => 'homepage.php',
	'/marlin/level3/index.php' => 'homepage.php',
	'/marlin/level3/user/create' => 'page_create_user.php',
	'/marlin/level3/user/create_user.php' => 'create_user.php',	
	'/marlin/level3/user/edit_user.php' => 'edit_user.php',	
];


$requested_route = $_SERVER['REQUEST_URI'];

//направляем на страницу редактирования
if (preg_match('/user\/(\d+)\/edit/', $requested_route, $matches)) {
	$_GET['id'] = $matches[1];
	include 'page_edit_user.php';
	exit;
}

//направляем на страницу удаления
if (preg_match('/user\/(\d+)\/delete/', $requested_route, $matches)) {
	$_GET['id'] = $matches[1];
	include 'delete_user.php';
	exit;
}

elseif(array_key_exists($requested_route, $routes)) {
	include $routes[$requested_route];
	exit;
}
else {
	var_dump(404);
}


?>