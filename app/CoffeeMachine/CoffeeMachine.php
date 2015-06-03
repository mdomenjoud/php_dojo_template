<?php

namespace CoffeeMachine;


class CoffeeMachine {

    public $return;
    /**
     * @var EmailNotifier
     */
    private $emailNotifier;
    /**
     * @var BeverageQuantityChecker
     */
    private $beverageQuantityChecker;

    public function __construct($emailNotifier, $beverageQuantityChecker) {
        $this->emailNotifier = $emailNotifier;
        $this->beverageQuantityChecker = $beverageQuantityChecker;

        $this->return = '';
    }
    public function buildOrder($drinkType, $nbSugar = 0, $inputMoney = 0)
    {
        $drink = new Drink($drinkType);

        if ($drink->name == 'invalid')
            return 'M:Invalid drink';


        if($inputMoney < $drink->price){
            return 'M:Not enought money';
        }

        if($this->beverageQuantityChecker->isEmpty($drinkType)){
            $this->emailNotifier->notify("Missing $drinkType, please refill");
            return "M:We can't deliver $drinkType. An email was sent to ask for refill";
        }

        $this->return = $drink->code;

        if(!$drink->acceptSugar){
            $nbSugar = 0;
        }
        $this->addSugar($nbSugar);

        return $this->return;
    }


    public function addSugar($numberSugar) {
        if ($numberSugar == 1)
            $this->return .= ':1:0';
        elseif ($numberSugar > 2 || $numberSugar == 2)
            $this->return .= ':2:0';
        else
            $this->return .= '::';
    }
}
