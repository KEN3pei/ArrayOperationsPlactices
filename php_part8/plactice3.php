<?php
//演習問題8.12-3
require_once "formhelper.php";

try{
    $db = new PDO('mysql:host=docker-practice_mysql_1;dbname=plactice','root','pass');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    $sql = "SELECT dish_id, dish_name FROM dishes";
    $stmt = $db->query($sql);
    $dishes = $stmt->fetchAll();

    foreach($dishes as $dish){
        $dish_names[$dish->dish_id] = $dish->dish_name;
    }
    // var_dump($dish_names);

}catch(PDOException $e){
    print $e->getMessage();
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    list($errors, $dishes) = validate();
    if($errors){
        show_form($errors);
    }else{
        process_form($dishes);
    }
}else{
    show_form();
}

function show_form($errors = array()){

    $form = new FormHelper;
    
    include "plactice3-form.php";
}

function validate(){
    global $db;
    $errors = array();

    $dish_id = filter_input(INPUT_POST, 'dish_id', FILTER_VALIDATE_INT);
    if($dish_id === null || $dish_id === false){
        $errors[] = 'Please enter minimum';
    }

    $sql = "SELECT * FROM dishes WHERE dish_id = $dish_id";
    $stmt = $db->query($sql);
    $dishes = $stmt->fetch();
    
    return array($errors, $dishes);
}

function process_form($dishes){

    if($dishes){
        print '<table>';
        print '<tr><th>Dish ID</th><th>Dish Name</th><th>Price</th><th>is_spicy</th></tr>';
        printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',
                htmlentities($dishes->dish_id), $dishes->dish_name, $dishes->price, $dishes->is_spicy);
        print '<table>';
    }

    $form = new FormHelper;
    include "plactice3-form.php";
}
