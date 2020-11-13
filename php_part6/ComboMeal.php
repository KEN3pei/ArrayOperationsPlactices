<?php

namespace PHP_git\php_part6;
error_reporting(E_ALL);

require_once "Entree.php";
use PHP_git\php_part6\Entree;

class ComboMeal{
    private $name;
    private $entrees;

    public function __construct($name, $entrees){
        // parent::__construct($name, $entrees);
        foreach($entrees as $entree){
            if(!$entree instanceof Entree){
                throw new \Exception("Elements of $entrees must be Entree object");
            }
        }
        $this->name = $name;
        $this->entrees = $entrees;
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
        foreach($this->entrees as $priceentree){
            // var_dump($priceentree);
            $total += $priceentree->getCost();

        }
        return $total;
    }
}