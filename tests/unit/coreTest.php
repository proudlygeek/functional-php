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
			return "<p>" . $el . "</p>";
		});

		$this->assertEquals(array("<p>1</p>", "<p>2</p>", "<p>3</p>"), $result);
	}

	public function test_filter()
	{
		$result = Core::filter(array("Apple", "Banana", "Strawberry"), function($el) { 
			return strlen($el) > 5;
		});

		$this->assertEquals(array("Banana", "Strawberry"), $result);
	}
}