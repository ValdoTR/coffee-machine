# Causeway: Machine à Café

## Description

Cette application simule une machine à café qui permet à l'utilisateur de sélectionner et de personnaliser différentes boissons (café, thé, chocolat) en ajoutant du sucre et du lait.

L'application utilise des design patterns tels que **State** et **Decorator** pour gérer les différentes étapes de l'interaction avec la machine.

En effet nous pouvons considérer cette machine à café comme un automate de type [FSM](https://en.wikipedia.org/wiki/Finite-state_machine).

## Diagram

```mermaid
classDiagram
    class CoffeeMachine {
        $state
        setState()
        selectDrink()
        selectSugar()
        selectMilk()
        dispenseDrink()
        insertCoin()
        start()
        cancel()
    }

    class CoffeeMachineState {
        <<interface>>
        selectDrink()
        selectSugar()
        selectMilk()
        dispenseDrink()
        insertCoin()
        start()
        cancel()
    }

    class AbstractCoffeeMachineState {
        <<abstract>>
    }

    class DrinkChoiceState {
        selectDrink() OptionsChoiceState
        cancel() DrinkChoiceState
    }

    class OptionsChoiceState {
        selectSugar()
        selectMilk()
        dispenseDrink() PaymentState
        cancel() DrinkChoiceState
    }

    class PaymentState {
        insertCoin() DispenseState
        cancel() DrinkChoiceState
    }

    class DispenseState {
        start() DrinkChoiceState
        cancel() DrinkChoiceState
    }

    CoffeeMachine --> CoffeeMachineState
    CoffeeMachineState <|-- AbstractCoffeeMachineState : implements
    AbstractCoffeeMachineState <|-- DrinkChoiceState : extends
    AbstractCoffeeMachineState <|-- OptionsChoiceState : extends
    AbstractCoffeeMachineState <|-- PaymentState : extends
    AbstractCoffeeMachineState <|-- DispenseState : extends

    DrinkChoiceState --> OptionsChoiceState : selectDrink()
    OptionsChoiceState --> PaymentState : dispenseDrink()
    PaymentState --> DispenseState : insertCoin()
    DispenseState --> DrinkChoiceState : start()

    DrinkChoiceState --> DrinkChoiceState : cancel()
    OptionsChoiceState --> DrinkChoiceState : cancel()
    PaymentState --> DrinkChoiceState : cancel()
    DispenseState --> DrinkChoiceState : cancel()
```

## Installation

Clone the project
composer install

ça aussi ?
composer dump-autoload -o

## Usage

Run tests unit tests

```shell
./vendor/bin/phpunit tests
```
