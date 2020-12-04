<?php

require_once "formhelper.php";

try{
    $db = new PDO('');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    $sql = "SELECT dish_name FROM dishes";
    $stmt = $db->query($sql);
    $dishe_names = $stmt->fetch(PDO::FETCH_ASSOC);

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
    $input = array();
    $errors = array();

    $input['dishe_name'] = $_POST['dishe_name'] ?? '';
    $dish = $db->quote($input['price']);
    $dish = strtr($dish, array('_' => '\_', '%' => '\%'));

    $sql = "SELECT * FROM dishes WHERE dish_name >= ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($dish));
    $dishes = $stmt->fetchAll();

    return array($errors, $dishes);
}

function process_form($dishes){

    if(count($dishes) == 0){
        print 'No dishes matched';
    }else{
        print '<table>';
        print '<tr><th>Dish ID</th><th>Dish Name</th><th>Price</th><th>is_spicy</th></tr>';
        foreach($dishes as $dish){
            printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',
                    htmlentities($dish->dish_id), $dish->dish_name, $dish->price, $dish->is_spicy);
        }
        print '<table>';
    }

    $form = new FormHelper;
    include "plactice3-form.php";
}
