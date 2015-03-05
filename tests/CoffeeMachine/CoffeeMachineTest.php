<?php

namespace CoffeeMachine;

require __DIR__ . '/../../bootstrap.php';

class CoffeeMachineTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var CoffeeMachine
     */
    private $coffeeMachine;

    public function setup(){
        $this->coffeeMachine = new CoffeeMachine();
    }

    public function test_makeCommand_ShouldReturnCoffeeCommand(){
        //When
        $result = $this->coffeeMachine->makeCommand("Coffee");

        //Then
        $this->assertEquals("C::", $result);
    }

    public function test_makeCommand_ShouldReturnTeaCommand(){
        //When
        $result = $this->coffeeMachine->makeCommand("Tea");

        //Then
        $this->assertEquals("T::", $result);
    }

    public function test_makeCommand_ShouldReturnChocolateCommand(){
        //When
        $result = $this->coffeeMachine->makeCommand("Chocolate");

        //Then
        $this->assertEquals("H::", $result);
    }

    public function test_makeCommand_ShouldReturnWrongTypeMessage_WhenDrinkTypeIsUnknown(){

        //When
        $result = $this->coffeeMachine->makeCommand("Pepsi");

        //Then
        $this->assertEquals("M:Unknown drink type", $result);
    }
}
 