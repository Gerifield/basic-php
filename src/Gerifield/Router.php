<?php
/**
 * @author gerifield <gerifield@ustream.tv>
 */

namespace Gerifield;


class Router
{
	/**
	 * @var \AltoRouter
	 */
	private $altoRouter;

	public static function create()
	{
		return new self(
			new \AltoRouter()
		);
	}

	public function __construct($altoRouter)
	{
		$this->altoRouter = $altoRouter;
	}

	public function addRoute($method, $route, $target, $name = null)
	{
		//Add the route as the default name, without the starting /
		if (!$name) {
			$name = mb_substr($route, 1);
		}

		$this->altoRouter->map($method, $route, $target, $name);
	}

	public function match($requestUrl = null, $requestMethod = null)
	{
		return $this->altoRouter->match($requestUrl, $requestMethod);
	}

	public function generate($routeName, $params = array())
	{
		return $this->altoRouter->generate($routeName, $params);
	}
}
