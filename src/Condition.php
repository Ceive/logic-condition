<?php
/**
 * @created Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Project: ceive.logic-condition
 */

namespace Ceive\Logic\Condition;

/**
 * @Author: Alexey Kutuzov <lexus27.khv@gmail.com>
 * Class Condition
 * @package Ceive\Logic\Condition
 */
class Condition implements CheckableInterface{
	
	public $left;
	
	public $operator;
	
	public $right;
	
	/**
	 * @param $context
	 * @return bool
	 */
	public function check($context){
		if($this->left){
			$left = $this->_checkoutOperand($this->left,$context);
			$operator = $this->operator;
			$right = $this->right;
			if($operator){
				if($right){
					$right = $this->_checkoutOperand($right,$context);
				}
			}
			return $this->_compareOperator($left, $operator, $right);
		}
		
		return true;
	}
	
	/**
	 * @param $path
	 * @param $context
	 * @return mixed
	 */
	public function contextGet($path, $context){
		return $context->{$path};
	}
	
	/**
	 * @param $operand
	 * @param $context
	 * @return mixed
	 */
	public function _checkoutOperand($operand, $context){
		if($operand instanceof AttributeLocationInterface){
			return $operand->getFrom($context);
		}
		if(is_string($operand)){
			if( (substr($operand,0,1) === '{') && (substr($operand,-1) === '}') ){
				$path = substr($operand,1,-1);
				return $this->contextGet($path, $context);
			}
		}
		
		return $operand;
	}
	
	/**
	 * @param $left
	 * @param null $operator
	 * @param null $right
	 * @return bool
	 */
	public function _compareOperator($left, $operator = null, $right = null){
		$negate = substr($left,0,1) === '!';
		if($operator===null){
			return $negate? !$left : !!$left;
		}
		return $left === $right;
	}
	
}


