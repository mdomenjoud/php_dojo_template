<?php


namespace CoffeeMachine;

interface EmailNotifier {
    public function notifyMissingDrink($drink);
}