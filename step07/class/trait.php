<?php

/**
 * @file trait.php
 * @author franck pichon
 * @version 1.0
 * @date 27 nov. 2016
 * 
 * @brief 
 * @details 
 */

trait getSetVal
{
	public function getVal($name)
	{
		if(is_array($name)){
			$name = $name[0];
		}
		if(property_exists(get_called_class(),$name)) {
			return $this->{$name};
		}
	}
	
	public function setVal($name, $val)
	{
		if(property_exists(get_called_class(),$name))
			$this->{$name} = $val;
	}
}

trait jsonData
{
	public function getJsonData($object, $debug = false) {
		$returnArray = get_object_vars($object);
		foreach ($returnArray as $key => $val) {
			if($key[0]=='_') {
				$returnArray[substr($key, 1)] = $returnArray[$key];
				unset($returnArray[$key]);
			}
			if(is_object($val)) {
				$returnArray[$key] = $this->getJsonData($val, $debug);
			}
			elseif(is_array($val)) {
				$returnArray[$key] = $this->recurData($val, $debug);
			} else {
				$returnArray[$key] = $val;
			}
		}
		return $returnArray;
	}

	public function recurData($data, $debug = false) {
		$returnArray = [];
		if($debug) {
			var_dump($data);
		}
		foreach($data as $key => $val) {
			if($key[0]=='_') {
				$data[substr($key, 1)] = $data[$key];
				unset($data[$key]);
			}
			if($debug) {
				var_dump($data[$key]);
			}
			if(is_object($data[$key])) {
				$returnArray[$key] = $this->getJsonData($data[$key], $debug);
			}
			elseif(is_array($data[$key])) {
				$returnArray[$key] = $this->recurData($data[$key], $debug);
			}else {
				$returnArray[$key] = $data[$key];
			}
		}
		return $returnArray;
	}
}

trait populate
{
	public function populate($row){
		foreach($row as $key => $value){
			$this->setVal($key,$value);
		}
	}
}

?>