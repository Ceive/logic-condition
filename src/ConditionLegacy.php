<?php
/**
 * @created Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Project: ceive.logic-condition
 */

namespace Ceive\Logic\Condition;

/**
 * Специально для наследования условий (Разделения конекста использования)
 * @Author: Alexey Kutuzov <lexus27.khv@gmail.com>
 * Class ConditionLegacy
 * @package Ceive\Logic\Condition
 */
class ConditionLegacy implements CheckableInterface{
	
	/** @var  CheckableInterface|null */
	protected $parent;
	
	/** @var CheckableInterface  */
	protected $wrapped;
	
	/**
	 * ConditionLegacy constructor.
	 * @param CheckableInterface $wrapped
	 */
	public function __construct(CheckableInterface $wrapped){
		$this->wrapped = $wrapped;
	}
	
	/**
	 * @return CheckableInterface
	 */
	public function getCondition(){
		return $this->wrapped;
	}
	
	/**
	 * @param CheckableInterface|null $checkable
	 * @return $this
	 */
	public function setParent(CheckableInterface $checkable = null){
		$this->parent = $checkable;
		return $this;
	}
	
	/**
	 * @return CheckableInterface|null
	 */
	public function getParent(){
		return $this->parent;
	}
	
	
	/**
	 * @param $attributes
	 * @return boolean
	 */
	public function check($attributes){
		$value = true;
		if($this->parent){
			$value = $this->parent->check($attributes);
		}
		return $value && $this->wrapped->check($attributes);
	}
	
	/**
	 * @param bool $if
	 * @return Composition|null
	 */
	public function factoryComposition($if = false){
		$stack = $this->stack();
		
		if(!$if || $stack){
			$composition = new Composition();
			foreach($stack as $checkable){
				$composition->add($checkable,$composition::OP_AND);
			}
			return $composition;
		}
		
		return null;
	}
	
	/**
	 * @param Composition $composition
	 * @return $this
	 */
	public function saturateComposition(Composition $composition){
		foreach($this->stack() as $checkable){
			if($checkable instanceof ConditionLegacy){
				$checkable = $checkable->getCondition();
			}
			$composition->add($checkable,$composition::OP_AND);
		}
		return $this;
	}
	
	/**
	 * from root ancestor to this wrapped
	 * @return CheckableInterface[]
	 */
	public function stack(){
		$condition = $this;
		$a = [];
		while($condition){
			$a[] = $condition;
			if($condition instanceof ConditionLegacy){
				$condition = $condition->parent;
			}else{
				$condition = null;
			}
		}
		return array_reverse($a);
	}
}


