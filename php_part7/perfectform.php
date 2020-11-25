<?php
require_once "formhelper.php";

$sweets = array(
    'puff' => 'Sesame Seed',
    'square' => 'Cocount Milk Gelatin',
    'cake' => 'Brown Suger Cake',
    'ricemeat' => 'Sweet Rice and Meat',
);
$main_dishes = array(
    'cuke' => 'Braised Sea Cucumber',
    'stomach' => 'Sauteed Pig`s Stomach',
    'tripe' => 'Sauteed tripe with Wine',
    'taro' => 'Stewed Pork With Taro',
    'Giblets' => 'Baked Giblets With Salt',
    'Abalone' => 'Abalone with Marrow',
);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    list($errors, $input) = validate();
    if($errors){
        show_form($errors);
    }else{
        process_form($input);
    }
}else{
    show_form();
}

function show_form($errors = array()){
    $defaults = array('delivery' => 'yes',
                      'size' => 'medium');
    $form = new FormHelper($defaults);
    include 'complete-form.php';
}

function validate(){
    $input = array();
    $errors = array();

    $input['name'] = trim($_POST['name'] ?? '');
    if(!strlen($input['name'])){
        $errors[] = 'Please enter your name';
    }
    $input['size'] = $_POST['size'] ?? '';
    if(!in_array($input['size'], ['small', 'medium', 'large'])){
        $errors[] = 'Please select a size';
    }
    $input['sweet'] = $_POST['sweet'] ?? '';
    if(!array_key_exists($input['sweet'], $GLOBALS['sweets'])){
        $errors[] = 'Please select a valid sweet item';
    }
    $input['main_dish'] = $_POST['main_dish'] ?? array();
    if(count($input['main_dish']) != 2){
        $errors[] = 'Please select exactry two main dishes';
    }else{
        if(!(array_key_exists($input['main_dish'][0], $GLOBALS['main_dishes']) &&
             array_key_exists($input['main_dish'][1], $GLOBALS['main_dishes']))){
            $errors[] = 'Please select exactry two valid main dishes';
        }
    }
    $input['delivary'] = $_POST['delivery'] ?? 'no';
    $input['comments'] = trim($_POST['comments'] ?? '');
    if(($input['delivary'] == 'yes') && (!strlen($input['comments']))){
        $errors[] = 'Please enter your address for delivery';
    }

    return array($errors, $input);
}

function process_form($input){
    $sweet = $GLOBALS['sweets'][$input['sweet']];
    $main_dish_1 = $GLOBALS['main_dishes'][$input['main_dish'][0]];
    $main_dish_2 = $GLOBALS['main_dishes'][$input['main_dish'][1]];
    if(isset($input['delivary']) && ($input['delivary'] == 'yes')){
        $delivery = 'do';
    }else{
        $delivery = 'do not';
    }
    $message = "Thank you for order, {$input['name']}";
    if(strlen(trim($input['comments']))){
        $message .= 'Your comments:' .$input['comments'];
    } 
    var_dump($input);
    mail('chef@restaurant.example.com', 'New Order', $message);
    print nl2br(htmlentities($message, ENT_HTML5));
}
