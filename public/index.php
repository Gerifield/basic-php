<?php

require __DIR__.'/../vendor/autoload.php';


$router = Router::getInstance()->getRouter();
$match  = $router->match();

ob_start();
session_start();

if ($match) {
	if (strstr($match['target'], '@')) {
		$route = explode('@', $match['target']);

		if (count($route) < 2) {
			throw new Exception('Wrong route definition');
		}

		//Create and call controller
		$controller = 'Controller\\'.$route[0];
		if (!class_exists($controller)) {
			throw new Exception('Controller not found');
		}

		$controller = new $controller($router);
		$method     = $route[1];
		if (!method_exists($controller, $method)) {
			throw new Exception('Method not found');
		}

		call_user_func_array( array($controller, $method), $match['params'] );

	} else if (is_callable($match['target'])) {
		call_user_func_array( $match['target'], $match['params'] );
	} else {
		header( $_SERVER["SERVER_PROTOCOL"] . ' 500 Internal server error');
	}
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
ob_end_flush();