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

	public function testMatch()
	{
		$this->altoRouter->expects($this->once())
			->method('match')
			->with('testUrl', 'testMethod')
			->willReturn('success');

		$this->assertEquals('success', $this->object->match('testUrl', 'testMethod'));
	}
}
