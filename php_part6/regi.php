<?php
// http://localhost/php_part6/regi.php

require_once "Entree.php";
require_once "Ingredient.php";
require_once "ComboMeal.php";
require_once 'PricedEntree.php';
// use PHP_git\php_part6\Entree;
use php_part6\Ingredient;
use php_part6\PricedEntree;
use php_part6\ComboMeal;


$chickin = new Ingredient("chickin", 500);
$water = new Ingredient("water", 100);
$soup = new PricedEntree("Chickin Soup", array($chickin, $water));
// $soup->getCost();

$chickin = new Ingredient("chickin", 500);
$bread = new Ingredient("bread", 200);
$sandwich = new PricedEntree("Chickin Sandwich", array($chickin, $bread));
// $sandwich->getCost();


$combo = new ComboMeal("Soup + Sandwich", array($soup, $sandwich));
$totalcost = $combo->totalCosts();
echo $totalcost;

