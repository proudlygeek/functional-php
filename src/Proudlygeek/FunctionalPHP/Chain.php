<?php

namespace Proudlygeek\FunctionalPHP;

class Chain {

    private $obj;
    private $library;

	public function __construct($obj, $library=null) {
		$this->obj = $obj;
        $this->library = $library;
	}

	public function getObj()
	{
		return $this->obj;
	}

	public function setObj($obj)
	{
		$this->obj = $obj;
	}

    public function setLibrary($library)
    {
        $this->library = $library;
    }

    public function getLibrary()
    {
        return $this->library;
    }

	public function value()
	{
		return $this->getObj();
	}

	public function __call($method, $args) {
        array_unshift($args, $this->obj);
        $result = call_user_func_array($this->library . "::" . $method, $args);

        if (!is_null($result)) {
            $this->setObj($result);
        }

        return $this;
	}

}