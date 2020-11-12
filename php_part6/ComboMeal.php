<?php

namespace PHP_git\php_part6;
// error_reporting(E_ALL);

require_once "Entree.php";
require_once "Ingredient.php";
use PHP_git\php_part6\Entree;
use PHP_git\php_part6\Ingredient;

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

    public function totalCosts(){
        $total = 0;
        foreach($this->ingredients as $value){
            var_dump($value);
            $total += $value->ingCosts();

        }
        return $total;
    }
}
// $total_cost = $combo->totalCosts($ing_costs);
// echo $total_cost . "</br>";

// foreach(["chickin", "lemon", "bread", "water"] as $ing){
//     if($combo->hasIngredient($ing)){
//         echo $ing . "</br>";
//     }
// }