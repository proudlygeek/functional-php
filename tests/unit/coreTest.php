<?php

namespace test\unit; 

use Proudlygeek\FunctionalPHP\Core;


class CoreTest extends \PHPUnit_Framework_TestCase {
	public function setUp() 
	{

	}

	public function test_each()
	{
		$result = array();

		Core::each(array(1, 2, 3), function($element) use (&$result) {
			$result[]= $element + 1;
		});

		$this->assertEquals(array(2, 3, 4), $result);
	}

	public function test_map()
	{
		$result = Core::map(array(1, 2, 3), function($el) {
			"<p>" . $el . "</p>";
		});

		$this->assertEquals(array("<h1>1</h1>", "<h1>2</h1>", "<h1>3</h1>"), $result);
	}
}