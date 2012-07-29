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
		return array();
	}
	
}