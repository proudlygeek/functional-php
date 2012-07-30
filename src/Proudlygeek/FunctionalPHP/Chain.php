<?php

namespace Proudlygeek\FunctionalPHP;

/**
 *
 */
class Chain {

    /**
     * @var
     */
    private $obj;
    /**
     * @var null
     */
    private $library;

    /**
     * @param $obj
     * @param null $library
     */
    public function __construct($obj, $library=null) {
		$this->obj = $obj;
        $this->library = $library;
	}

    /**
     * @return mixed
     */
    public function getObj()
	{
		return $this->obj;
	}

    /**
     * @param $obj
     */
    public function setObj($obj)
	{
		$this->obj = $obj;
	}

    /**
     * @param $library
     */
    public function setLibrary($library)
    {
        $this->library = $library;
    }

    /**
     * @return null
     */
    public function getLibrary()
    {
        return $this->library;
    }

    /**
     * @return mixed
     */
    public function value()
	{
		return $this->getObj();
	}

    /**
     * @param $method
     * @param $args
     * @return Chain
     */
    public function __call($method, $args) {
        array_unshift($args, $this->obj);
        $result = call_user_func_array($this->library . "::" . $method, $args);

        if (!is_null($result)) {
            $this->setObj($result);
        }

        return $this;
	}

}