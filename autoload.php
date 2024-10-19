<?php declare(strict_types=1);

// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'CoffeeMachineState' => '/CoffeeMachineState.php',
                'IllegalStateTransitionException' => '/IllegalStateTransitionException.php',
                'AbstractCoffeeMachineState' => '/AbstractCoffeeMachineState.php',
                'DrinkChoiceState' => '/DrinkChoiceState.php',
                'OptionsChoiceState' => '/OptionsChoiceState.php',
                'PaymentState' => '/PaymentState.php',
                'DispenseState' => '/DispenseState.php',
                'CoffeeMachine' => '/CoffeeMachine.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    }
);
// @codeCoverageIgnoreEnd