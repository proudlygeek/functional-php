<?php

namespace Proudlygeek\FunctionalPHP;


class Core {
	
	public static function each(array $iterable, $block) {
		foreach($iterable as $el) {
			$block($el);
		}
	}

	public static function map(array $iterable, $block) {
		
		$result = array();

		foreach($iterable as $el) {
			$result[]= $block($el);
		}

		return $result;
	}

	public static function filter(array $iterable, $block) {
		
		$result = array();

		foreach($iterable as $el) {
			if ($block($el)) {
				$result[] = $el;
			}
		}

		return $result;
	}

	public static function reduce(array $iterable, $block) {
		
		$partialResult = $iterable[0];

		for ($i = 1; $i < count($iterable); $i++) {
			$partialResult = $block($partialResult, $iterable[$i]);
		}

		return $partialResult;
	}
	
}