<?php

class Registry {
	
	private static $obj;
	private $objects = array();
	
	public static function getInstance() {
		if (!isset(self::$obj)) {
			self::$obj = new Registry();
		}
		return self::$obj;
	}

    public function set($key, $object)
    {
    	
        if (!array_key_exists($key, $this->objects)) 
        	$this->objects[$key] = $object;
    }

    public function get($key)
    {
        if (array_key_exists($key, $this->objects)) 
        	return $this->objects[$key];
        else return false;
    }
	
}