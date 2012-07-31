<?php

namespace Proudlygeek\FunctionalPHP;

/**
 * FunctionalPHP - Chain class
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *
 * Objects builts using this class can be used to
 * chain-call methods like this one:
 *
 * $result = Core::chain($devs)
 *   ->select(function($el) { return strtolower(substr($el['name'], 0, 1)) == "g"; })
 *   ->reject(function($el) { return in_array("Ruby", $el['skills']); })
 *   ->pluck('name')
 *   ->value();
 *
 * There's no direct instantiation of objects from this class since
 * it's managed from Core class's chain method.
 *
 */
class Chain
{

    /**
     * @var The wrapped object
     */
    private $obj;
    /**
     * @var String The class containing the static methods
     */
    private $library;

    /**
     * Constructs a chained object given an object and the class
     * which contains the static functional methods.
     *
     * @param $obj The object to be wrapped
     * @param string $library The namespaced class name containing the static methods
     */
    public function __construct($obj, $library = null)
    {
        $this->obj = $obj;
        $this->library = $library;
    }

    /**
     * Gets the object.
     *
     * @return mixed
     */
    public function getObj()
    {
        return $this->obj;
    }

    /**
     * Sets the object.
     *
     * @param $obj
     */
    public function setObj($obj)
    {
        $this->obj = $obj;
    }

    /**
     * Sets the library class name.
     *
     * @param $library
     */
    public function setLibrary($library)
    {
        $this->library = $library;
    }

    /**
     * Gets the library class name.
     *
     * @return string
     */
    public function getLibrary()
    {
        return $this->library;
    }

    /**
     * Alias for getObj()
     *
     * @return mixed
     */
    public function value()
    {
        return $this->getObj();
    }

    /**
     * Routes all the method calls to the injected class;
     * it always return ($this) itself for further method chaining.
     *
     * @param $method
     * @param $args
     * @return Chain
     */
    public function __call($method, $args)
    {
        array_unshift($args, $this->obj);
        $result = call_user_func_array($this->library . "::" . $method, $args);

        if (!is_null($result)) {
            $this->setObj($result);
        }

        return $this;
    }

}