<?php

namespace Proudlygeek\FunctionalPHP;

use Proudlygeek\FunctionalPHP\Chain;

/**
 *
 */
class Core {

    /**
     * @static
     * @param array $iterable
     * @param $block
     */
    public static function each(array $iterable, $block)
	{
		foreach($iterable as $el) {
			$block($el);
		}
	}

    /**
     * @static
     * @param array $iterable
     * @param $block
     * @return array
     */
    public static function map(array $iterable, $block)
	{
		
		$result = array();

		foreach($iterable as $el) {
			$result[]= $block($el);
		}

		return $result;
	}

    /**
     * @static
     * @param array $iterable
     * @param $block
     * @return null
     */
    public static function find(array $iterable, $block)
	{
		foreach ($iterable as $el) {
			if ($block($el)) {
				return $el;
			}
		}

		return null;
	}

    /**
     * @static
     * @param array $iterable
     * @param $block
     * @return array
     */
    public static function select(array $iterable, $block)
	{
		
		$result = array();

		foreach($iterable as $el) {
			if ($block($el)) {
				$result[] = $el;
			}
		}

		return $result;
	}

    /**
     * @static
     * @param array $iterable
     * @param $block
     * @return array
     */
    public static function reject(array $iterable, $block)
	{
		$result = array();

		foreach($iterable as $el) {
			if (!$block($el)) {
				$result[] = $el;
			}
		}

		return $result;
	}

    /**
     * @static
     * @param array $iterable
     * @param $block
     * @return mixed
     */
    public static function reduce(array $iterable, $block)
	{
		
		$partialResult = $iterable[0];

		for ($i = 1; $i < count($iterable); $i++) {
			$partialResult = $block($partialResult, $iterable[$i]);
		}

		return $partialResult;
	}

    /**
     * @static
     * @param array $iterable
     * @param $block
     * @return bool
     */
    public static function any(array $iterable, $block)
	{
		foreach($iterable as $el) {
			if ($block($el)) {
				return true;
			}
		}

		return false;
	}

    /**
     * @static
     * @param array $iterable
     * @param $block
     * @return bool
     */
    public static function all(array $iterable, $block)
	{
		foreach($iterable as $el) {
			if (!$block($el)) {
				return false;
			}
		}

		return true;
	}

    /**
     * @static
     * @param array $iterable
     * @param $field
     * @return array
     */
    public static function pluck(array $iterable, $field)
	{
		$result = array();

		foreach($iterable as $el) {
			$result[]= $el[$field];
		}

		return $result;
	}

    /**
     * @static
     * @param array $iterable
     * @param $block
     * @return bool
     */
    public static function max(array $iterable, $block)
	{
		$max = $block($iterable[0]);

		next($iterable);

		foreach($iterable as $el) {
			if($current = $block($el) > $max) {
				$max = $current;
			}
		}

		return $max;
	}

    /**
     * @static
     * @param array $iterable
     * @param $block
     * @return bool
     */
    public static function min(array $iterable, $block)
	{
		$min = $block($iterable[0]);

		next($iterable);

		foreach($iterable as $el) {
			if($current = $block($el) < $min) {
				$min = $current;
			}
		}

		return $min;
	}

    /**
     * @static
     * @param array $obj
     * @return Chain
     */
    public static function chain(array $obj)
	{
		$chain = new Chain($obj);
        $chain->setLibrary('Proudlygeek\FunctionalPHP\Core');

        return $chain;
	}
	
}