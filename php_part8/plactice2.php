<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
// 演習問題8.12-2
require_once "formhelper.php";

try{
    $db = new PDO('mysql:host=docker-practice_mysql_1;dbname=plactice','root','pass');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
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
    print "<form action=" .$form->encode($_SERVER['PHP_SELF']). " method='POST'>".
          $form->input('text',['name' => 'price']).
          $form->input('submit', ['value' => 'Order']).
          "</form>";
}

function validate(){
    $input = array();
    $errors = array();

    $input['price'] = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    if($input['price'] === null || $input['price'] === false){
        $errors[] = 'Please enter minimum';
    }

    return array($errors, $input);
}

function process_form($input){
    global $db;

    $dish = $input['price'];
    $sql = "SELECT dish_name, price FROM dishes WHERE price >= ?";
    $stmt = $db->prepare($sql);
    $stmt->execute((array)$dish);
    $dishes = $stmt->fetchAll();
    

    if(count($dishes) == 0){
        print 'No dishes matched';
    }else{
        print '<table>';
        print '<tr><th>Dish Name</th><th>Price</th></tr>';
        foreach($dishes as $dish){
            printf('<tr><td>%s</td><td>%s</td></tr>',
                    htmlentities($dish->dish_name), $dish->price);
        }
        print '<table>';
    }
}
