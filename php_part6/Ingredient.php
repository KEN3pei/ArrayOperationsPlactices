<?php
namespace php_part6;

class Ingredient{
    private $name;
    private $cost;

    public function __construct($name, $cost){
        $this->name = $name;
        $this->cost = $cost;
    }

    public function changeCost($cost){
        $this->cost = $cost;
    }

    // public function getName(){
    //     return $this->name;
    // }

    public function getCost(){
        return $this->cost;
    }
}
?>