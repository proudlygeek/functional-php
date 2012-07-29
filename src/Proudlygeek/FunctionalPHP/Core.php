<?php

namespace Proudlygeek\FunctionalPHP;


class Core {

	public static function each(array $iterable, $block) {
		foreach($iterable as $el) {
			$block($el);
		}
	}
}