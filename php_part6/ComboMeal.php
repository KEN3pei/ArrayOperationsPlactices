<?php
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
            foreach($entree->ingredients as $value){
                if($value->getName() == $ingredient){
                    return true;
                }
            }
        }
        return false;
    }

    public function totalCosts(){
        $total = 0;
        foreach($this->ingredients as $entree){
            foreach($entree->ingredients as $value){
                $total += $value->getCost(); 
            }
        }
        return $total;
    }
}
$chickin = new Ingredient("chickin", "500");
$water = new Ingredient("water", "100");
$soup = new Entree("Chickin Soup", array($chickin, $water));

$chickin = new Ingredient("chickin", "500");
$bread = new Ingredient("bread", "200");
$sandwich = new Entree("Chickin Sandwich", array($chickin, $bread,));

$combo = new ComboMeal("Soup + Sandwich", array($soup, $sandwich));
$total_cost = $combo->totalCosts();
echo $total_cost . "</br>";

foreach(["chickin", "lemon", "bread", "water"] as $ing){
    if($combo->hasIngredient($ing)){
        echo $ing . "</br>";
    }
}

