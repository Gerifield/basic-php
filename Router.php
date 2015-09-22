<?php
/**
 * @author gerifield <gerifield@ustream.tv>
 */

class Router
{
	private static $instance;

	public static function getInstance()
	{
		if (!isset(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function getRouter()
	{
		$router = Gerifield\Router::create();

		// Example routes
		//$router->addRoute('GET', '/asdf', 'MainController@index', 'main/index'); //Named router
		//$router->addRoute('GET', '/asdf', 'MainController@index'); //Auto named route

		return $router;
	}
}
