<?php
/**
 * @created Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Project: ceive.logic-condition
 */

namespace Ceive\Logic\Condition;

/**
 * @Author: Alexey Kutuzov <lexus27.khv@gmail.com>
 * Class AttributeLocation
 * @package Ceive\Logic\Condition
 */
class AttributeLocation implements AttributeLocationInterface{
	
	protected $location;
	
	public function __construct($location){
		$this->location = $location;
	}
	
	/**
	 * @param $attributes
	 * @return mixed
	 */
	public function getFrom($attributes){
		return $attributes[$this->location];
	}
	
	/**
	 * @param $attributes
	 * @param $value
	 * @return mixed
	 */
	public function setTo($attributes, $value){
		// TODO: Implement setTo() method.
	}
}


