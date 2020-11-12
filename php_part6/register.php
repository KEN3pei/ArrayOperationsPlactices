<?php

require_once "Entree.php";
require_once "Ingredient.php";
require_once 'ComboMeal.php';
use PHP_git\php_part6\Entree;
use PHP_git\php_part6\Ingredient;
use PHP_git\php_part6\ComboMeal;


$chickin = new Ingredient("chickin", 500);
$water = new Ingredient("water", 100);
$soup = new Entree("Chickin Soup", array($chickin, $water));
// $soup->ingCosts();


$chickin = new Ingredient("chickin", 500);
$bread = new Ingredient("bread", 200);
$sandwich = new Entree("Chickin Sandwich", array($chickin, $bread));
// $sandwich->ingCosts();


$combo = new ComboMeal("Soup + Sandwich", array($soup, $sandwich));
$totalcost = $combo->totalCosts();
echo $totalcost;

