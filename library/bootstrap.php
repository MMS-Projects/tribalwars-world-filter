<?php
require_once(ROOT . "/config/config.php");

error_reporting(~0);
if (INDEVELOPMENT) {
	ini_set("display_errors", true);
} else {
	ini_set("display_errors", false);
}

function getAutoloadFileName ($name) {
	if (file_exists(ROOT . "/application/controllers/" . $name . ".php")) {
		return ROOT . "/application/controllers/" . $name . ".php";
	} else if (file_exists(ROOT . "/application/models/" . $name . ".php")) {
		return ROOT . "/application/models/" . $name . ".php";
	} else if (file_exists(ROOT . "/library/" . $name . ".php")) {
		return ROOT . "/library/" . $name . ".php";
	}
	return false;
}
function __autoload ($name) {
	$name = strtolower($name);
	$filename = getAutoloadFileName ($name);
	if (!$filename) return;
	require_once $filename;
}
function main () {
	global $url;
	
	$url = array_filter(explode('/', $url));
	if (!isset($url[0])) throw new Exception ("Controller not specified");
	$controllerName = strtolower(trim(array_shift($url)));
	$action     = (isset($url[1])) ? strtolower(trim(array_shift(($url)))) : 'default';
	$query      = $url;
	
	$class = 'Controller' . ucfirst($controllerName);
	$model = 'Model' . ucfirst($controllerName);
	$controller = new $class;
	$controller->action = $action;
	$controller->name   = $controllerName;
	if (($file = getAutoloadFileName($model))) {
		require_once $file;
		$controller->model  = new $model;		
	}
	
	call_user_func_array(array($controller, 'action' . $action), array($query));
}
$url = (isset($_GET['url'])) ? $_GET['url'] : 'home/';
if (strlen(trim($url)) === 0) $url = 'home/';
try {
	main();
} catch (Exception $e) {
	if (INDEVELOPMENT) {
		throw $e;
	} else { 
		$url = "/error/";
		try {
			main();
		} catch (Exception $e) {
			echo "Oops, something went wrong :(";
		}
	}
}
