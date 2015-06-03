<?php
/**
 * Created by IntelliJ IDEA.
 * User: MDO
 * Date: 01/06/2015
 * Time: 17:35
 */

namespace CoffeeMachine;


interface EmailNotifier {

    public function notify($drinkType);

}