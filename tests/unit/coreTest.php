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

	public function test_pluck()
	{
		$result = Core::pluck(array(
			array(
				'name' => "John",
				'last' => "Doe"
			),
			array(
				'name' => "Jane",
				'last' => "Doe"
			),
			array(
				'name' => "Mario",
				'last' => "Rossi"
			),
		), 'name');

		$this->assertEquals(array("John", "Jane", "Mario"), $result);
	}

	public function test_max()
	{
		$result = Core::max(array(
			array('name' => "John", 'age' => 37),
			array('name' => "Jane", 'age' => 24),
			array('name' => "Mario", 'age' => 56)
		), function($person) {
			return $person['age'];
		});

		$this->assertEquals(56, $result);
	}

	public function test_min()
	{
		$result = Core::max(array(
			array('name' => "John", 'age' => 37),
			array('name' => "Jane", 'age' => 24),
			array('name' => "Mario", 'age' => 56)
		), function($person) {
			return $person['age'];
		});

		$this->assertEquals(24, $result);
	}

	public function test_simpleChain()
	{
		$result = Core::chain(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))
			->select(function($n) { return $n > 5; })
			->value();

		$this->assertEquals(array(6, 7, 8, 9, 10), $result);
	}

    public function test_mediumChain()
    {
        $result = Core::chain(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))
            ->select(function($n) { return $n > 5; })
            ->reject(function($n) { return $n % 2 == 0; })
            ->all(function($n) { return $n % 2 != 0; })
            ->value();

        $this->assertTrue($result);
    }
}