<?php
namespace PHP_git\php_part6;
//前菜を表す
class Entree{
    private $name;
    protected $ingredients = array();

    //※constructorは返り値を返さないため問題発生による通知を行うことができない。
    public function __construct($name, $ingredient){
        if(!is_array($ingredient)){
            throw new \Exception('$ingredient must be array');
        }
        $this->ingredients = $ingredient;
        $this->name = $name;
    }

    //$this->ingredientsに引数の値が含まれているかチェックし、trueかfalseを返している。
    public function hasIngredient($ingredient){
        // var_dump($this->ingredients);
        return in_array($ingredient, $this->ingredients);
    }

    public static function getSize(){
        return array("small", "midiam", "large");
    }
}
