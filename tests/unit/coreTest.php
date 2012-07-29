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

	public function test_select()
	{
		$result = Core::select(array("Apple", "Banana", "Strawberry"), function($el) { 
			return strlen($el) > 5;
		});

		$this->assertEquals(array("Banana", "Strawberry"), $result);
	}

	public function test_reject()
	{
		$result = Core::reject(array("Apple", "Banana", "Strawberry"), function($el) { 
			return strlen($el) > 5;
		});

		$this->assertEquals(array("Apple"), $result);
	}

	public function test_find()
	{
		$result = Core::find(array(11, 45, 12, 9, 2), function($el) {
			return $el % 2 == 0;
		});

		$this->assertEquals(12, $result);
	}

	public function test_reduce()
	{
		$result = Core::reduce(array(1, 2, 3, 4, 5, 6), function($x, $y) {
			return $x + $y;
		});

		$this->assertEquals(21, $result);
	}

	public function test_any()
	{
		$result = Core::any(array(1, 2, 3, 4), function($el) {
			return $el % 2 == 0;
		});

		$this->assertTrue($result);
	}

	public function test_all()
	{
		$result = Core::all(array(2, 4, 6, 8), function($el) {
			return $el % 2 == 0;
		});

		$this->assertTrue($result);
	}
}