<?php

namespace CoffeeMachine;

use Phake;

require __DIR__ . '/../../bootstrap.php';

class CoffeeMachineTest extends \PHPUnit_Framework_TestCase {

    private $coffeeMachine;

    private $emailNotifier;
    private $beverageQuantityChecker;

    public function drinkTypes(){
        return array(
            array("Chocolate", "H::", 1, "should accept chocolate"),
            array("Tea", "T::", 1, "should accept tea"),
            array("Coffee", "C::", 1, "should accept coffee"),
            array("Coffe", "M:Invalid drink", 1, "invalid drink"),
            array("Orange", "O::", 1, "should accept orange"),
        );
    }

    public function setup()
    {
        $this->emailNotifier = Phake::mock('CoffeeMachine\EmailNotifier');
        $this->beverageQuantityChecker = Phake::mock('CoffeeMachine\BeverageQuantityChecker');
        $this->coffeeMachine = new CoffeeMachine($this->emailNotifier, $this->beverageQuantityChecker);
    }

    /**
     * @dataProvider drinkTypes
     */
    public function test_buildOrder_ShouldAcceptDrink($input, $expected, $money, $message){
        //Given


        //WHen
        $result = $this->coffeeMachine->buildOrder($input, false, $money);

        //Then
        $this->assertEquals($expected, $result, $message);
    }

    public function test_buildOrder_ShouldAcceptCoffeeWithSugar(){
        //WHen
        $result = $this->coffeeMachine->buildOrder("Coffee", true, 1);

        //Then
        $this->assertEquals("C:1:0", $result);
    }

    public function test_buildOrder_ShouldAcceptCoffeeWithMoreThanTwoSugar(){
        //WHen
        $result = $this->coffeeMachine->buildOrder("Coffee", 3, 1);

        //Then
        $this->assertEquals("C:2:0", $result);
    }

    public function test_buildOrder_ShouldAcceptCoffeeWithLessThanZeroSugar(){
        //WHen
        $result = $this->coffeeMachine->buildOrder("Coffee", -1, 1);

        //Then
        $this->assertEquals("C::", $result);
    }

    public function test_buildOrder_ShouldAcceptCoffeeWithTwoSugar(){
        //WHen
        $result = $this->coffeeMachine->buildOrder("Coffee", 2, 1);

        //Then
        $this->assertEquals("C:2:0", $result);
    }

    public function test_buildOrder_IsNotEnoughtMoney(){
        //WHen
        $result = $this->coffeeMachine->buildOrder("Coffee", 2, 0.3);

        //Then
        $this->assertEquals("M:Not enought money", $result);
    }

    public function test_buildOrder_ShouldNotAcceptOrangeWithSugar(){
        //WHen
        $result = $this->coffeeMachine->buildOrder("Orange", 2, 1);

        //Then
        $this->assertEquals("O::", $result);
    }

    public function test_simpleMock(){
        //Given
        Phake::when($this->beverageQuantityChecker)->isEmpty("Coffee")->thenReturn(true);

        //WHen
        $this->coffeeMachine->buildOrder("Coffee", 2, 1);

        //Then
        Phake::verify($this->emailNotifier)->notify("Missing Coffee, please refill");
    }
}
 