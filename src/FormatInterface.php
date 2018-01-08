<?php
/**
 * @created Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Project: ceive.logic-condition
 */

namespace Ceive\Logic\Condition;

/**
 * @Author: Alexey Kutuzov <lexus.1995@mail.ru>
 * Interface FormatInterface
 * @package Ceive\Logic\Condition
 */
interface FormatInterface{
	
	/**
	 * @param CheckableInterface $checkable
	 * @return mixed
	 */
	public function build(CheckableInterface $checkable);
	
}

