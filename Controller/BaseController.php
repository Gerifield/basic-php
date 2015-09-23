<?php
/**
 * @author gerifield <gerifield@ustream.tv>
 */

namespace Controller;

use Gerifield\Router;

abstract class BaseController
{
	/**
	 * @var Router
	 */
	private $router;

	/**
	 * @var \Twig_Environment
	 */
	private $twig;

	public function __construct(Router $router)
	{
		$twigLoader = new \Twig_Loader_Filesystem(\GlobalConfig::get('TWIG.TEMPLATE_PATH'));
		$this->twig = new \Twig_Environment($twigLoader, array(
			'cache' => \GlobalConfig::get('TWIG.CACHE_PATH')
		));

		$this->router = $router;
	}

	public function render($template, $params = array())
	{
		echo $this->twig->render($template, $params);
	}

	public function getVariable($name, $type = 'post', $defaultValue = '')
	{
		switch (strtolower($type)) {
			case 'post':
				return $this->getValueFromArray($_POST, $name, $defaultValue);
				break;
			case 'get':
				return $this->getValueFromArray($_GET, $name, $defaultValue);
				break;
			case 'session':
				return $this->getValueFromArray($_SESSION, $name, $defaultValue);
				break;
			case 'file':
				return $this->getValueFromArray($_FILES, $name, $defaultValue);
				break;
			default:
				return $this->getValueFromArray($_REQUEST, $name, $defaultValue);
		}
	}

	public function redirect($routeName, $params = array(), $statusCode = 302, $withExit = true)
	{
		$url = $this->router->generate($routeName, $params);
		$this->redirectURL($url, $statusCode, $withExit);
	}

	public function redirectURL($url, $statusCode = 302, $withExit = true)
	{
		header('Location: '.$url, true, $statusCode);

		if ($withExit) {
			exit;
		}
	}

	public function jsonSuccess($result = array())
	{
		$result['success'] = true;
		$this->json($result);
	}

	public function jsonFailure($result = array())
	{
		$result['success'] = false;
		$this->json($result);
	}

	public function json($result = array())
	{
		header('Content-Type: text/html; charset=utf-8');
		echo json_encode($result);
	}

	public function enableCORSFromUrls($urls = array('*'))
	{
		header('Access-Control-Allow-Origin: '.implode(',', $urls));
	}

	private function getValueFromArray($array, $value, $defaultValue = '')
	{
		if (!isset($array[$value])) {
			return $defaultValue;
		} else {
			return $array[$value];
		}
	}
}