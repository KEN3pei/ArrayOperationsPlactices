<?php
error_reporting(E_ALL);

require_once "Entree.php";
require_once "Ingredient.php";
use Entree\Entree;
use Ingredient\Ingredient;

class ComboMeal extends Entree{

    public function __construct($name, $entrees){
        parent::__construct($name, $entrees);
        foreach($entrees as $entree){
            if(!$entree instanceof Entree){
                throw new \Exception("Elements of $entrees must be Entree object");
            }
        }
    }

    public function hasIngredient($ingredient){
        foreach($this->ingredients as $entree){
            if($entree->hasIngredient($ingredient)){
                return true;
            }
        }
        return false;
    }
    
    public function totalCosts($ing_costs){
        $total = 0;
        foreach($ing_costs as $value){
            if($this->hasIngredient($value[0])){
                echo $value[0] . "</br>";
                $total += $value[1];
                $ingredient[] = new Ingredient($value[0], $value[1]);
            }
        }
        // var_dump($this->ingredients);
        return $total;
    }
}
// このままだと同じ値でも材料の数だけ入力しなければいけない
// entreeの配列にIngredientオブジェクトが入るようにしたい
$ing_costs = [
    ["chickin", "500"],
    ["water", "100"],
    ["chickin", "500"],
    ["bread", "200"]
];

$soup = new Entree("Chickin Soup", array("chickin", "water"));
$sandwich = new Entree("Chickin Sandwich", array("chickin", "bread"));

$combo = new ComboMeal("Soup + Sandwich", array($soup, $sandwich));
$total_cost = $combo->totalCosts($ing_costs);
echo $total_cost . "</br>";

// foreach(["chickin", "lemon", "bread", "water"] as $ing){
//     if($combo->hasIngredient($ing)){
//         echo $ing . "</br>";
//     }
// }