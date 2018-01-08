<?php
/**
 * @Creator Alexey Kutuzov <lexus27.khv@gmail.com>
 * @Author: Alexey Kutuzov <lexus27.khv@gmai.com>
 * @Project: ceive.logic-condition
 */

namespace Ceive\Logic\Condition\Tests;


use Ceive\Logic\Condition\CheckableInterface;
use Ceive\Logic\Condition\Composition;
use Ceive\Logic\Condition\Condition;
use Ceive\Logic\Condition\ConditionLegacy;

class BasicCase extends \PHPUnit_Framework_TestCase{
	
	/**
	 *
	 * @see CheckableInterface  - Интерфейс "Проверяемый"
	 * @see CheckableInterface::check
	 *
	 * @see Condition           - Простое условие напр. a == b
	 *
	 * @see ConditionLegacy     - Наследуемое условие (DesignPattern: Декоратор для @CheckableInterface)
	 *
	 * @see ConditionLegacy::setParent(CheckableInterface)      - Родительское условие
	 * @see ConditionLegacy::getParent():CheckableInterface     - Родительское условие
	 * @see ConditionLegacy::getCondition():CheckableInterface  - Обернутое условие
	 *
	 * @see ConditionLegacy::stack();                           - Превращает цепочку наследования в массив с @CheckableInterface
	 * @see ConditionLegacy::saturateComposition($composition); - Наполняет условиями объект Composition через оператор AND
	 *
	 * @see Composition - Связка условий с разделением OR AND (гр. говоря: Блок условий)
	 *
	 */
	public function testBasic(){
		
		$condition1 = new Condition();
		$condition1->left        = 5;
		$condition1->operator    = '==';
		$condition1->right       = 5;
		$conditionLegacy1 = new ConditionLegacy($condition1);
		
		$condition2 = new Condition();
		$condition2->left        = 10;
		$condition2->operator    = '==';
		$condition2->right       = 10;
		$conditionLegacy2 = new ConditionLegacy($condition2);
		$conditionLegacy2->setParent($conditionLegacy1);
		
		
		
		$composition = new Composition();
		$conditionLegacy2->saturateComposition($composition);
		
		
		$composition->items;
		
	}
	
}


