<?php

namespace CoffeeMachine;

require __DIR__ . '/../../bootstrap.php';

class CoffeeMachineTest extends \PHPUnit_Framework_TestCase
{

    public function test_Dummy()
    {
        $this->assertEquals("Chuck Norris", "Chuck " . "Norris");
    }

    public function test_Failing()
    {
        $this->assertEquals(42, 4 + 2);
    }

    public function test_autoload()
    {
        $coffeeMachine = new CoffeeMachine();

        $this->assertNotNull($coffeeMachine);
    }
}
 