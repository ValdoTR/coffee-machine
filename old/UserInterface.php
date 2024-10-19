<?php

// Étape 7 (Bonus) : Interface utilisateur en ligne de commande

/*
 * En executant ce script à l'aide de php il est possible
 * d'intéragir avec la machine à café et tester facilement
 * toutes les possibilités 
*/

require_once 'State.php';
require_once 'Drink.php';
require_once 'Coffee.php';
require_once 'Tea.php';
require_once 'Chocolate.php';
require_once 'SugarDecorator.php';
require_once 'MilkDecorator.php';
require_once 'ReadyState.php';
require_once 'DrinkSelectionState.php';
require_once 'CustomizationState.php';
require_once 'CoffeeMachine.php';

// Créer une instance de CoffeeMachine
$coffeeMachine = new CoffeeMachine();

// Créer une instance de UserInterface en passant l'objet CoffeeMachine
$userInterface = new UserInterface($coffeeMachine);

// Lancer la machine à café en appelant la méthode buyDrink()
$userInterface->buyDrink();

class UserInterface {
    private $coffeeMachine;
    private $step;
    private $feedback;

    public function __construct(CoffeeMachine $coffeeMachine, string $step = "coin", string $feedback = "") {
        $this->coffeeMachine = $coffeeMachine;
        $this->step = $step;
        $this->feedback = $feedback;
    }

    // Gestion de la boucle principale pour les interactions
    public function buyDrink() {
        while (true) {
            // Pièces
            if ($this->step === "coin") {
                $coins = $this->validateNumericInput($this->getUserInput("Insérez des pièces"), 1, 9);
                if ($coins === -1) {
                    continue;
                }
                $this->coffeeMachine->insertMoney($coins);
                $this->feedback = "";
                $this->step = "drink";
            }

            // Boisson
            if ($this->step === "drink") {
                $drinkChoice = $this->validateNumericInput($this->getUserInput("Sélectionnez une boisson (1-3)"), 0, 3);
                if ($drinkChoice === -1) {
                    continue;
                }
                $this->coffeeMachine->selectDrink($this->formatDrinkChoice($drinkChoice));
                $this->feedback = "";
                $this->step = "sugar";
            }

            // Sucre
            if ($this->step === "sugar") {
                $sugarLevel = $this->validateNumericInput($this->getUserInput("Choisissez le niveau de sucre (0-4)"), 0, 4);
                if ($sugarLevel === -1) {
                    continue;
                }
                $this->coffeeMachine->selectSugarLevel($sugarLevel);
                $this->feedback = "";
                $this->step = "milk";
            }


            // Lait
            if ($this->step === "milk") {
                $milkLevel = $this->validateNumericInput($this->getUserInput("Choisissez le niveau de lait (0-4)"), 0, 4);
                if ($milkLevel === -1) {
                    continue;
                }
                $this->coffeeMachine->selectMilkLevel($milkLevel);
                $this->feedback = "";
                $this->step = "dispense";
            }

            // Distribution
            $this->coffeeMachine->dispenseDrink();
            $this->feedback = $this->formatSuccess("Votre boisson est prête!");

            // Recommencer ou quitter
            $input = $this->getUserInput("Voulez-vous une autre boisson ? (o/N)");
            
            if (strtolower($input) !== 'o') {
                $this->handleExit();
            }

            $this->step === "coin";
        }
    }

    private function getUserInput(string $prompt): string {
        $this->updateUI($prompt);
        $input = trim(fgets(STDIN));
    
        // Gestion de la touche 'q' pour quitter
        if (strtolower($input) === 'q') {
            $this->handleExit();
            exit;
        }
    
        return $input;
    }

    private function updateUI(string $question = "") {
        // Efface l'écran pour actualiser l'interface
        system('clear');

        // Afficher le choix de la boisson (asterisk si choix OK)
        //$coffeeChoice = 
    
        // Récupère le crédit et les niveaux de sucre et de lait
        $coins = $this->coffeeMachine->getCurrentCoins();
        $sugarUI = $this->getSugarLevelUI();
        $milkUI = $this->getMilkLevelUI();
    
        // Affichage de l'interface de la machine à café en ASCII art
        echo "
             _______________________
            |    CAUSEWAY GUSTO     |
            |_______________________|
            |                       |
            | (1) \033[93mCafé\033[0m           2€ |
            | (2) \033[93mThé\033[0m            3€ |
            | (3) \033[93mChocolat\033[0m       5€ |
            |_______________________|
            |  ___________________  |
            | |    Crédit \033[93m{$coins}€\033[0m      | |
            | |   _______         | |
            | |  |       |    ||  | |
            | |  |       |        | |
            | |  |_______|    (q) | |
            | |___________________| |
            |_______________________|
            |         Sucre         |
            |  (0)  [\033[93m{$sugarUI}\033[0m]  (4)  |
            |         Lait          |
            |  (0)  [\033[93m{$milkUI}\033[0m]  (4)  |
            |_______________________|
    
            > $question :
            $this->feedback
            ";
    }

    // Génère l'interface du niveau de sucre
    private function getSugarLevelUI(): string {
        return $this->generateLevelUI($this->coffeeMachine->getSugarLevel());
    }

    // Génère l'interface du niveau de lait
    private function getMilkLevelUI(): string {
        return $this->generateLevelUI($this->coffeeMachine->getMilkLevel());
    }

    private function generateLevelUI(int $level, int $max = 4): string {
        $level = max(0, min($max, $level));
        $stringWithTrailingSpace =  str_repeat('* ', $level) . str_repeat('  ', $max - $level);
        return mb_substr($stringWithTrailingSpace, 0, -1);
    }

    // Gère la sortie et la récupération des pièces
    private function handleExit() {
        // Efface l'écran pour actualiser l'interface
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

        if ($this->coffeeMachine->getCurrentCoins() > 0) {
            echo $this->formatSuccess("Vous récuperez {$this->coffeeMachine->getCurrentCoins()} pièces.");
        }
              
        $this->coffeeMachine->reset();

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

    public function formatDrinkChoice(int $drinkNumber): string {
        switch ($drinkNumber) {
            case 1:
                return 'coffee';
            case 2:
                return 'tea';
            case 3:
                return 'chocolate';
            default:
                return null;
        }
    }

    private function formatError(string $message): string {
        return "\033[31m$message\033[0m";
    }

    private function formatSuccess(string $message): string {
        return "\033[32m$message\033[0m";
    }

    private function getDrinkByNumber(int $drinkNumber): string {
        return match ($drinkNumber) {
            1 => "coffee",
            2 => "tea",
            3 => "chocolate",
            default => "none"
        };
    }
}
