<?php

namespace Proudlygeek\FunctionalPHP;


class Core {
	
	public static function each(array $iterable, $block) 
	{
		foreach($iterable as $el) {
			$block($el);
		}
	}

	public static function map(array $iterable, $block) 
	{
		
		$result = array();

		foreach($iterable as $el) {
			$result[]= $block($el);
		}

		return $result;
	}

	public static function find(array $iterable, $block)
	{
		foreach ($iterable as $el) {
			if ($block($el)) {
				return $el;
			}
		}

		return null;
	}

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

	public static function reduce(array $iterable, $block) 
	{
		
		$partialResult = $iterable[0];

		for ($i = 1; $i < count($iterable); $i++) {
			$partialResult = $block($partialResult, $iterable[$i]);
		}

		return $partialResult;
	}

	public static function any(array $iterable, $block) 
	{
		foreach($iterable as $el) {
			if ($block($el)) {
				return true;
			}
		}

		return false;
	}

	public static function all(array $iterable, $block) 
	{
		foreach($iterable as $el) {
			if (!$block($el)) {
				return false;
			}
		}

		return true;
	}

	public static function pluck(array $iterable, $field)
	{
		$result = array();

		foreach($iterable as $el) {
			$result[]= $el[$field];
		}

		return $result;
	}

	public static function max(array $iterable, $block)
	{
		$max = 0;

		foreach($iterable as $el) {
			if($current = $block($el) > $max) {
				$max = $current;
			}
		}

		return $max;
	}
	
}