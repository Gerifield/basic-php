<?php
/**
 * @author gerifield <gerifield@ustream.tv>
 */

namespace UnitTest\Gerifield;

use Gerifield\Router;

class RouterTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var \PHPUnit_Framework_MockObject_MockObject
	 */
	private $altoRouter;

	/**
	 * @var Router
	 */
	private $object;

	protected function setUp()
	{
		parent::setUp();

		$this->altoRouter = $this->getMock('\AltoRouter');

		$this->object = new Router(
			$this->altoRouter
		);
	}

	public function testCreate()
	{
		$this->assertInstanceOf('\Gerifield\Router', Router::create());
	}

	public function testAddRouteWithoutName()
	{
		$this->altoRouter->expects($this->once())
			->method('map')
			->with('testMethod', '/testRoute', 'testTarget', 'testRoute');

		$this->object->addRoute('testMethod', '/testRoute', 'testTarget');
	}

	public function testAddRouteWithName()
	{
		$this->altoRouter->expects($this->once())
			->method('map')
			->with('testMethod', '/testRoute', 'testTarget', 'testRouteName');

		$this->object->addRoute('testMethod', '/testRoute', 'testTarget', 'testRouteName');
	}

	public function testMatch()
	{
		$this->altoRouter->expects($this->once())
			->method('match')
			->with('testUrl', 'testMethod')
			->willReturn('success');

		$this->assertEquals('success', $this->object->match('testUrl', 'testMethod'));
	}

	public function testGenerate()
	{
		$this->altoRouter->expects($this->once())
			->method('generate')
			->with('routerName', array('routeParam1', 'routeParam2'))
			->willReturn('success');

		$this->assertEquals('success', $this->object->generate('routerName', array('routeParam1', 'routeParam2')));
	}
}
