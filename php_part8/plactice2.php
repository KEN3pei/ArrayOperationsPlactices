<?php
// 演習問題8.12-2
require_once "formhelper.php";

try{
    $db = new PDO('mysql:host=web_mysql_1;dbname=plactice','root','pass');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

    $input['price'] = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT);
    if($input['price'] === null || $input['price'] === false){
        $errors[] = 'Please enter minimum';
    }

    return array($errors, $input);
}

function process_form($input){
    global $db;

    $sql = "SELECT (dish_name, price) FROM dishes WHERE price >= ?";
    $dish = $db->quote($input['price']);
    $dish = strtr($dish, array('_' => '\_', '%' => '\%'));

    $stmt = $db->prepare($sql);
    $stmt->execute(array($dish));
    $dishes = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    if(count($dishes) == 0){
        print 'No dishes matched';
    }else{
        print '<table>';
        print '<tr><th>Dish Name</th><th>Price</th></tr>';
        foreach($dishes as $key => $dish){
            printf('<tr><td>%s</td><td>%s</td></tr>',
                    htmlentities($key), $dish);
        }
        print '<table>';
    }
}
