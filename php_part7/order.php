<?php
require_once "formhelper.php";

for($i=1; $i<=36; $i++){
    $size[$i] = $i;
}

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
    $form = new FormHelper;
    // var_dump($form);
    include 'order-form.php';
}

function validate(){
    $input = array();
    $errors = array();

    $input['send'] = trim($_POST['send'] ?? '');
    if(!strlen($input['send'])){
        $errors[] = 'Please try again send data';
    }
    $input['address'] = trim($_POST['address'] ?? '');
    if(!strlen($input['address'])){
        $errors[] = 'Please try again address data';
    }
    $input['zipcode'] = trim($_POST['zipcode'] ?? '');
    if(!preg_match('/^([0-9]{5})(-[0-9]{4})?$/i', $input['zipcode'])){
        if(!preg_match('/^([0-9]{5})$/', $input['zipcode'])){
            $errors[] = 'Please try again zipcode data';
        }
    }
    $input['size'] = $_POST['size'] ?? '';
    if($input['size'] > 36 || (!strlen($input['size']))){
        $errors[] = 'Please try again select a size';
    }
    $input['weight'] = trim($_POST['weight'] ?? '');
    if(!strlen($input['weight']) || ($input['weight'] > 150)){
        $errors[] = 'Please try again weight data';
    }
    return array($errors, $input);
}

function process_form($input){
    
    $message = "発送元は{$input['send']}\n";
    $message .= "宛先は{$input['address']}\n";
    $message .= "郵便番号は{$input['zipcode']}\n";
    $message .= "Sizeは{$input['size']}\n";
    $message .= "Weightは{$input['weight']}\n";
    // var_dump($input);
    print nl2br(htmlentities($message, ENT_HTML5));
}