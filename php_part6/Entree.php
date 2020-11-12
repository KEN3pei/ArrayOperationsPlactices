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

    public function ingCosts(){
        $total = 0;
//         var_dump($this->ingredients[0]->getCost());
        foreach($this->ingredients as $value){
            $total += $value->getCost();
        }
//         echo $total;
        return $total;
    }
}


//EntreeというオブジェクトにChickin Soupというdataを割り当ててインスタンスを作っている
// $soup = new Entree("Chickin Soup", array("chickin", "water"));
// $soup->name = "cryrice";
// echo $soup->name;

//同じくChickin Sandwich同じくというdataを与えてインスタンスを作っている
// $sandwich = new Entree("Chickin Sandwich", array("chickin", "bread"));

// foreach(["chickin", "lemon", "bread", "water"] as $ing){
//     if($soup->hasIngredient($ing)){
//         echo "soup contains". $ing . "\n";
//     }
// }

//静的メソッド呼び出し
// $size = Entree::getSize();
// var_dump($size);

//例外を発生させる
// try{
//     $drink = new Entree('Glass of milk', 'milk');
//     if($drink->hasIngredient('milk')){
//         echo "yummy!";
//     }
// }catch(\Exception $e){
//     echo "Couldn't create the drink:" . $e->getMessage();
// }

//以下のようなエラーを吐き出す
// Fatal error: Uncaught Exception: $ingredient must be array
// in /var/www/html/Entree.php:10 Stack trace: #0 /var/www/html/Entree.php(43):
// Entree->__construct('Glass of milk', 'milk') #1 {main} thrown in /var/www/html/Entree.php on line 10
// Uncaught(未捕捉) ＝ 致命的エラー
// Stack traceの{main}行はphpだと最後にかならず出てくる。
// Stack traceは停止するときに動作していた全関数を表示する。ここだと Entree->__construct('Glass of milk', 'milk') のこと