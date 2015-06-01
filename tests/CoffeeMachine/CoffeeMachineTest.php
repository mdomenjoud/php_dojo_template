<?php

namespace CoffeeMachine;

require __DIR__ . '/../../bootstrap.php';

class CoffeeMachineTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var CoffeeMachine
     */
    private $coffeeMachine;

    /**
     * @var EmailNotifier
     */
    private $emailNotifierMock;

    /**
     * @var BeverageQuantityChecker
     */
    private $beverageQuantityCheckerMock;

    public function setup(){

        $this->emailNotifierMock = $this->getMockBuilder('CoffeeMachine\\EmailNotifier')
            ->getMock();
        $this->beverageQuantityCheckerMock = $this->getMockBuilder('CoffeeMachine\\BeverageQuantityChecker')
            ->getMock();
        $this->coffeeMachine = new CoffeeMachine($this->emailNotifierMock, $this->beverageQuantityCheckerMock);
    }

    public function test_EmailNotifier(){
        //Given
        $this->emailNotifierMock = $this->getMockBuilder('CoffeeMachine\\EmailNotifier')
            ->getMock();

        $this->emailNotifierMock->expects($this->once())
            ->method('notifyMissingDrink')
            ->with($this->equalTo('Orange'));

        //When
        $this->emailNotifierMock->notifyMissingDrink("Orange");
    }

    public function test_BeverageQuantityChecker(){
        //Given
        $this->beverageQuantityCheckerMock =
            $this->getMockBuilder('CoffeeMachine\\BeverageQuantityChecker')
            ->getMock();

        $this->beverageQuantityCheckerMock->method('isEmpty')
            ->willReturn(false);

        //When
        $result = $this->beverageQuantityCheckerMock->isEmpty("Orange");

        //Then
        $this->assertEquals(false, $result);
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
 