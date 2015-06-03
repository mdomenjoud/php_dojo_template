<?php
namespace CoffeeMachine;

class Drink
{
    public $price;
    public $acceptSugar;
    public $code;
    public $name;

    public function __construct($type) {
        $this->name = $type;
        switch ($type) {
            case 'Tea' :
                $this->price = 0.4;
                $this->acceptSugar = true;
                $this->code = 'T';
                break;
            case 'Coffee' :
                $this->price = 0.6;
                $this->acceptSugar = true;
                $this->code = 'C';
                break;
            case 'Chocolate' :
                $this->price = 0.5;
                $this->acceptSugar = true;
                $this->code = 'H';
                break;
            case 'Orange' :
                $this->price = 0.6;
                $this->acceptSugar = false;
                $this->code = 'O';
                break;
            default :
                $this->name = 'invalid';
        }

        return $this;
    }
}

?>