<?php

"create table restaurents (
    
    client_id int not null primary key auto_increment, 
    name varchar(20) unique not null,
    tellnumber int not null,
    dish_id int not null

)";

require_once "formhelper.php";

try{
    $db = new PDO('mysql:host=web_mysql_1;dbname=plactice','root','pass');
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
    include "plactice4-form.php";
}

function validate(){
    global $db;
    $input = array();
    $errors = array();

    $input['name'] = trim($_POST['name'] ?? '');
    if(!strlen($input['name'])){
        $errors[] = 'Please try again name form';
    }

    $input['tell'] = $_POST['tell'] ?? '';
    if(!preg_match('/^([0-9]{11})$/', $input['tell'])){
        $errors[] = 'Please try again tell form';
    }

    $input['dishe_name'] = $_POST['dishe_name'] ?? '';
    $dish = $db->quote($input['dishe_name']);
    $dish = strtr($dish, array('_' => '\_', '%' => '\%'));

    $sql = "SELECT dish_id FROM dishes WHERE dish_name = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($dish));
    $dishe_id = $stmt->fetch(PDO::FETCH_ASSOC);

    if(count($dishe_id) == 0){
        $input['dish_id'] = '';
    }else{
        $input['dish_id'] = $dishe_id;
    }

    return array($errors, $input);
}

function process_form($input){
    global $db;

    if($input){
        $sql = "INSERT INTO restaurents (name, tellnumber, dish_id) VALUE (?, ?, ?)";
        $param = array(
            $input['name'],
            $input['tell'],
            $input['dish_id']
        );

        $stmt = $db->prepare($sql);
        $stmt->execute($param);
    }

    $form = new FormHelper;
    include "plactice4-form.php";
}
