<?php
//演習問題8.12-4
error_reporting(E_ALL);
ini_set("display_errors", 1);
// 数値と数字の違いをわかってなかったため電話番号登録でsqlエラーが出た
"create table restaurents (   
    client_id int not null primary key auto_increment, 
    name varchar(20) unique not null,
    tellnumber varchar(11) not null, 
    dish_id int not null
)";

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

    $input['tell'] = trim($_POST['tell'] ?? '');
    if(!preg_match('/^([0-9]{11})$/', $input['tell'])){
        $errors[] = 'Please try again tell form';
    }

    $input['dish_id'] = filter_input(INPUT_POST, 'dish_id', FILTER_VALIDATE_INT);
    if($input['dish_id'] === null || $input['dish_id'] === false){
        $errors[] = 'Please enter minimum';
    }
    
    return array($errors, $input);
}

function process_form($input){
    global $db;

    if($input){
        try{
            $sql = 'INSERT INTO restaurents (name, tellnumber, dish_id) VALUES (?,?,?)';
            $param = array(
                $input['name'],
                $input['tell'],
                (int)$input['dish_id']
            );

            $stmt = $db->prepare($sql);
            $stmt->execute($param);
            
        }catch(PDOException $e){
            
            print $e->getMessage();
        }
    }
    $errors = null;
    $form = new FormHelper;
    include "plactice4-form.php";
}
