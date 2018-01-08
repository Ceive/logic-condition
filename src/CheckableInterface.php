<?php
/**
 * @created Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Project: ceive.logic-condition
 */

namespace Ceive\Logic\Condition;

/**
 * @Author: Alexey Kutuzov <lexus.1995@mail.ru>
 * Interface CheckableInterface
 * @package Ceive\Logic\Condition
 */
interface CheckableInterface{
	
	/**
	 * @param $attributes
	 * @return boolean
	 */
	public function check($attributes);
	
	/**
	 * @param FormatInterface $format
	 * @return mixed
	 */
	//public function formatTo(FormatInterface $format);
	
}


