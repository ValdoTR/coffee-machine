<?php

require 'vendor/autoload.php';

use App\CoffeeMachine;
use App\Enum\DrinkEnum;
use App\State\DrinkChoiceState;

enum StepEnum {
    case DRINK;
    case SUGAR;
    case MILK;
    case PAYMENT;
    case DISPENSE;
}

$coffeeMachine = new CoffeeMachine(new DrinkChoiceState);
$userInterface = new UserInterface($coffeeMachine);

// Boot that very cool coffee machine!
$userInterface->useMachine();

class UserInterface {
    private StepEnum $step = StepEnum::DRINK;
    private string $feedback = "";
    private int $drink = 0;
    private int $credit = 0;
    private int $sugarLevel = 0;
    private int $milkLevel = 0;

    public function __construct(private CoffeeMachine $coffeeMachine)
    {       
    }

    // Primary loop of user interactions
    public function useMachine() {
        while (true) {
            $this->step = match ($this->step) {
                StepEnum::DRINK => $this->askForDrink(),
                StepEnum::SUGAR => $this->askForSugar(),
                StepEnum::MILK => $this->askForMilk(),
                StepEnum::PAYMENT => $this->askForPayment(),
                StepEnum::DISPENSE => $this->dispense(),
            };
        }
    }

    /**
     **************************** Steps ****************************
    */

    // Drink choice (Coffee, Tea, Chocolate)
    public function askForDrink(): StepEnum
    {
        while ($this->step === StepEnum::DRINK) {
            $this->drink = $this->validateNumericInput($this->getUserInput("Sélectionnez une boisson"), 1, 3);
            if ($this->drink === -1) {
                continue;
            }
            $this->coffeeMachine->selectDrink(DrinkEnum::from($this->drink));
            $this->feedback = "";
            return StepEnum::SUGAR;
        }
    }

    // Sucre
    public function askForSugar(): StepEnum
    {
        while ($this->step === StepEnum::SUGAR) {
            $this->sugarLevel = $this->validateNumericInput($this->getUserInput("Choisissez le niveau de sucre"), 0, 4);
            if ($this->sugarLevel === -1) {
                continue;
            }
            $this->coffeeMachine->selectSugar($this->sugarLevel);
            $this->feedback = "";
            return StepEnum::MILK;
        }
    }

    // Lait
    public function askForMilk(): StepEnum
    {
        while ($this->step === StepEnum::MILK) {
            $this->milkLevel = $this->validateNumericInput($this->getUserInput("Choisissez le niveau de lait"), 0, 4);
            if ($this->milkLevel === -1) {
                continue;
            }
            $this->coffeeMachine->selectMilk($this->milkLevel);
            $this->feedback = "";
            return StepEnum::PAYMENT;
        }
    }

    // Payment
    public function askForPayment(): StepEnum
    {
        while ($this->step === StepEnum::PAYMENT) {
            $this->coffeeMachine->confirmDrink();
            $drinkPrice = DrinkEnum::from($this->drink)->price();
            $coins = $this->validateNumericInput($this->getUserInput("Insérez au moins $drinkPrice pièces"), 1, 9);
            if ($coins === -1) {
                continue;
            }
            $this->coffeeMachine->insertCoin($coins);
            $this->credit += $coins;
            $this->feedback = "";
            return StepEnum::DISPENSE;
        }
    }

    // Dispense
    public function dispense(): StepEnum
    {
        while ($this->step === StepEnum::DISPENSE) {
            $this->credit -= DrinkEnum::from($this->drink)->price();
            $this->feedback = $this->formatSuccess("Votre boisson est prête!");

            // Recommencer ou quitter
            $input = $this->getUserInput("Voulez-vous une autre boisson ? (o/N)");
            
            if (strtolower($input) !== 'o') {
                $this->handleExit();
            }
            return StepEnum::DRINK;
        }
    }
    
    /**
     **************************** UI ****************************
    */

    // Ask question and wait for the user input
    private function getUserInput(string $prompt): string {
        $this->updateUI($prompt);
        $input = trim(fgets(STDIN));
    
        // User can press 'q' to quit
        if (strtolower($input) === 'q') {
            $this->handleExit();
            exit;
        }
    
        return $input;
    }

    private function updateUI(string $question = "") {
        // Clear the screen so that we can update it
        system('clear');

        // TODO: Display the drink choice (asterisk)
        //$coffeeChoice = 
    
        // Get sugar and milk UI levels
        $sugarUI = $this->getSugarLevelUI();
        $milkUI = $this->getMilkLevelUI();
    
        // Display of the coffee machine in ASCII-art
        echo "
             _______________________
            |    CAUSEWAY GUSTO     |
            |_______________________|
            |                       |
            | \033[93m(1)\033[0m Café           2€ |
            | \033[93m(2)\033[0m Thé            3€ |
            | \033[93m(3)\033[0m Chocolat       5€ |
            |_______________________|
            |  ___________________  |
            | |    Crédit {$this->credit}€      | |
            | |   _______         | |
            | |  |       |    ||  | |
            | |  |       |        | |
            | |  |_______|    \033[93m(q)\033[0m | |
            | |___________________| |
            |_______________________|
            |         Sucre         |
            |  \033[93m(0)\033[0m  [{$sugarUI}]  \033[93m(4)\033[0m  |
            |         Lait          |
            |  \033[93m(0)\033[0m  [{$milkUI}]  \033[93m(4)\033[0m  |
            |_______________________|
    
            > $question :
            $this->feedback
            ";
    }

    // Generates the sugar level interface
    private function getSugarLevelUI(): string {
        return $this->generateLevelUI($this->sugarLevel);
    }

    // Generates the milk level interface
    private function getMilkLevelUI(): string {
        return $this->generateLevelUI($this->milkLevel);
    }

    // Asterisk-based level bar generator
    private function generateLevelUI(int $level, int $max = 4): string {
        $level = max(0, min($max, $level));
        $stringWithTrailingSpace =  str_repeat('* ', $level) . str_repeat('  ', $max - $level);
        return mb_substr($stringWithTrailingSpace, 0, -1);
    }

    // Manage exit and coins change
    private function handleExit() {
        // Clear the screen so that we can update it
        system('clear');

        echo "
                    {
                {   }
                }_{ __{
             .-{   }   }-.
            (   }     {   )
            |`-.._____..-'|
            |             ;--.
            |            (__  \
            |             | )  )
            |             |/  /
            |             /  /     À bientôt
            |            (  /
            \             y'
             `-.._____..-'
        \n";

        if ($this->credit > 0) {
            echo $this->formatSuccess("Vous récuperez {$this->credit} pièces.");
        }

        $this->credit = 0;
        $this->sugarLevel = 0;
        $this->milkLevel = 0;

        // Attente que l'utilisateur appuie sur une touche avant de quitter
        echo "\n\nAppuyez sur Entrée pour quitter...";
        fgets(STDIN);
        exit;
    }

    private function validateNumericInput($input, $min, $max): int {
        $number = (int) $input;
        if ($number < $min || $number > $max) {
            $this->feedback = $this->formatError("Veuillez entrer un nombre entre $min et $max.");
            return -1;
        }

        return $number;
    }

    private function formatError(string $message): string {
        return "\033[31m$message\033[0m";
    }

    private function formatSuccess(string $message): string {
        return "\033[32m$message\033[0m";
    }
}
