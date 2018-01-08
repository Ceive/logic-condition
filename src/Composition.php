<?php
/**
 * @created Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Project: ceive.logic-condition
 */

namespace Ceive\Logic\Condition;
/**
 * @Author: Alexey Kutuzov <lexus27.khv@gmail.com>
 * Class Composition
 * @package Ceive\Logic\Condition
 */
class Composition implements CheckableInterface{
	
	const OP_AND    = 'AND';
	const OP_OR     = 'OR';
	
	/** @var CheckableInterface[]  */
	public $items = [];
	/** @var string[]  */
	public $operators = [];
	
	/**
	 * @param CheckableInterface $condition
	 * @param null $operator
	 * @return $this
	 */
	public function add(CheckableInterface $condition, $operator = null){
		$this->items[]      = $condition;
		$this->operators[]  = $operator?:self::OP_AND;
		return $this;
	}
	
	/**
	 * @param $condition
	 * @return $this
	 */
	public function addAnd(CheckableInterface $condition){
		return $this->add($condition, self::OP_AND);
	}
	
	/**
	 * @param $condition
	 * @return $this
	 */
	public function addOr(CheckableInterface $condition){
		return $this->add($condition, self::OP_OR);
	}
	
	/**
	 * @param $context
	 * @return bool|null
	 */
	public function check($context){
		$value = null;
		foreach($this->items as $i => $item){
			$operator = $this->operators[$i];
			$result = $item->check($context) || false;
			if(is_bool($result)){
				
				if($value === null){
					$value = $result;
				}else{
					switch($operator){
						case self::OP_AND:
							$value = $value && $result;
							break;
						case self::OP_OR:
							$value = $value || $result;
							break;
					}
				}
				
				
				// Заранее делаем вердикт на основе специфики операторов и полученного значения
				if($value){
					// если TRUE и следующее сравнение будет ИЛИ,
					// то итог заранее понятен вне зависимости от результата следующего сравнения
					if(isset($this->operators[$i+1]) && $this->operators[$i+1] === self::OP_OR){
						return $value;
					}
				}else{
					// если FALSE и следующее сравнение будет И,
					// то итог заранее понятен вне зависимости от результата следующего сравнения
					if(isset($this->operators[$i+1]) && $this->operators[$i+1] === self::OP_AND){
						return $value;
					}
				}
				
			}
		}
		return $value || false;
	}
	
	/**
	 * @param FormatInterface $format
	 * @return mixed
	 */
	public function formatTo(FormatInterface $format){
		return $format->build($this);
	}
}


