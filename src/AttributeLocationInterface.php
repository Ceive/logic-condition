<?php
/**
 * @created Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Project: ceive.logic-condition
 */

namespace Ceive\Logic\Condition;


/**
 * @Author: Alexey Kutuzov <lexus.1995@mail.ru>
 * Interface AccessToAttribute
 * @package Ceive\Logic\Condition
 */
interface AttributeLocationInterface{
	
	/**
	 * @param $attributes
	 * @return mixed
	 */
	public function getFrom($attributes);
	
	/**
	 * @param $attributes
	 * @param $value
	 * @return mixed
	 */
	public function setTo($attributes, $value);
	
}


