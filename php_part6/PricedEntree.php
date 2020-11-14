<?php
namespace php_part6;

error_reporting(E_ALL);

use php_part6\Entree;
use php_part6\Ingredient;

class PricedEntree extends Entree{

    public function __construct($name, $ingredients){
        parent::__construct($name, $ingredients);
        foreach($this->ingredients as $ingredient){
            if(!$ingredient instanceof Ingredient){
                throw new \Exception("Elements of $ingredient must be Entree object");
            }
        }
    }

    public function getCost(){
        $total = 0;
        foreach($this->ingredients as $ingredient){
            $total += $ingredient->getCost();
        }
        return $total;
        // echo $total;
    }
}