<?php

namespace Proudlygeek\FunctionalPHP;

use Proudlygeek\FunctionalPHP\Chain;

/**
 * FunctionalPHP - Core class
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~
 *
 * This is simply used as a method container, so basically
 * is a collection of static methods.
 *
 */
abstract class Core
{

    /**
     * Iterates over a list of elements yielding each element to a block
     * function.
     *
     * @static
     * @param array $iterable A list of values
     * @param $block The function to be called
     */
    public static function each(array $iterable, $block)
    {
        foreach ($iterable as $el) {
            $block($el);
        }
    }

    /**
     * Applies a block function to a list of elements.
     *
     * @static
     * @param array $iterable
     * @param $block The trasform function to be applied
     * @return array The transformed array
     */
    public static function map(array $iterable, $block)
    {

        $result = array();

        foreach ($iterable as $el) {
            $result[] = $block($el);
        }

        return $result;
    }

    /**
     * Find the first element that passes a truth test.
     *
     * @static
     * @param array $iterable A list of values
     * @param $block The function containing the truth test (must return a Boolean)
     * @return mixed|null
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
     * Iterates over a list and picks only the elements
     * that passes a truth test.
     *
     * @static
     * @param array $iterable A list of values
     * @param $block The function containing the truth test (must return a Boolean)
     * @return array The filtered array
     */
    public static function select(array $iterable, $block)
    {

        $result = array();

        foreach ($iterable as $el) {
            if ($block($el)) {
                $result[] = $el;
            }
        }

        return $result;
    }

    /**
     * Iterates over a list and picks only the elements
     * that does not pass a truth test.
     *
     * @static
     * @param array $iterable A list of values
     * @param $block The function containing the truth test (must return a Boolean)
     * @return array The filtered array
     */
    public static function reject(array $iterable, $block)
    {
        $result = array();

        foreach ($iterable as $el) {
            if (!$block($el)) {
                $result[] = $el;
            }
        }

        return $result;
    }

    /**
     * Reduces a list of values into a single value by applying
     * a function; is mandatory that this function use two parameters:
     * The first one is the memoized (cached) result, the second the next
     * value in the list.
     *
     * @static
     * @param array $iterable A list of values
     * @param $block The reduce function
     * @return mixed The reduced (scalar) result
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
     * Tests if there's at least one element in the list of values
     * that satisfies the function's truth test.
     *
     * @static
     * @param array $iterable A list of values
     * @param $block The function containing the truth test (must return a Boolean)
     * @return bool
     */
    public static function any(array $iterable, $block)
    {
        foreach ($iterable as $el) {
            if ($block($el)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Tests if all the elements in the list of values passes
     * the function's truth test.
     *
     * @static
     * @param array $iterable A list of values
     * @param $block The function containing the truth test (must return a Boolean)
     * @return bool
     */
    public static function all(array $iterable, $block)
    {
        foreach ($iterable as $el) {
            if (!$block($el)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Extracts a list of property values from the given list.
     *
     * @static
     * @param array $iterable A list of objects
     * @param $field The string name of the property to be extracted
     * @return array The list of the property
     *
     * @todo: support schema-less objects
     *
     */
    public static function pluck(array $iterable, $field)
    {
        $result = array();

        foreach ($iterable as $el) {
            $result[] = $el[$field];
        }

        return $result;
    }

    /**
     * Return the maximum value in list; the function is used to specify
     * the criterion for the maximum.
     *
     * @static
     * @param array $iterable A list of objects
     * @param $block A function returning the maximum criterium
     * @return int
     *
     * @todo: Return object instead of the scalar value
     */
    public static function max(array $iterable, $block)
    {
        $max = $block($iterable[0]);

        next($iterable);

        foreach ($iterable as $el) {
            if ($current = $block($el) > $max) {
                $max = $current;
            }
        }

        return $max;
    }

    /**
     * Return the minimum value in list; the function is used to specify
     * the criterion for the minimum.
     *
     * @static
     * @param array $iterable A list of objects
     * @param $block A function returning the mininum criterium
     * @return int
     *
     * @todo: Return object instead of the scalar value
     */
    public static function min(array $iterable, $block)
    {
        $min = $block($iterable[0]);

        next($iterable);

        foreach ($iterable as $el) {
            if ($current = $block($el) < $min) {
                $min = $current;
            }
        }

        return $min;
    }

    /**
     * Returns a wrapped object to enable chaining/functional
     * style method calls.
     *
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