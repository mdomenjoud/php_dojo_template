<?php

namespace CoffeeMachine;

class CoffeeMachine {

    public static $DrinkTypes = array(
        "Tea" => "T",
        "Coffee" => "C",
        "Chocolate" => "H"
    );

    public function makeCommand($drinkType = null)
    {
        if (isset(self::$DrinkTypes[$drinkType])) {
            return self::$DrinkTypes[$drinkType] . "::";
        }
        return "M:Unknown drink type";
    }
}
