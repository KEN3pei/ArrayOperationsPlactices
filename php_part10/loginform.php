<?php
require "formhelper.php";
session_start();

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

    if($errors){
        $errorHTML = '<ul><li>';
        $errorHTML .= implode('<li><li>', $errors);
        $errorHTML .= '</li></ul>';
    }else{
        $errorHTML = '';
    }
    print
    "<form method='POST' action='{$form->encode($_SERVER['PHP_SELF'])}'>
    $errorHTML
    username: {$form->input('text',['name' => 'username'])} <br/>
    password: {$form->input('text',['name' => 'password'])} <br/>
    {$form->input('submit',['value' => 'Log in'])}
    </form>";         
}

function validate(){
    global $db;
    $input = array();
    $errors = array();
    $password_ok = false;

    //この部分のpasswordに当たる値は本来ハッシュ化するべき
    // $users = array('alice' => 'dog123',
    //                'bob' => 'my^pwd',
    //                'charlie' => '**fun**');

    $input['username'] = $_POST['username'] ?? '';
    $submitted_password = $_POST['password'] ?? '';
    //db接続は関数外でできている前提
    $stmt = $db->prepare('SELECT password FROM users WHERE username = ?');
    $stmt->execute($input['username']);
    $row = $stmt->fetch();

    if($row){
        $password_ok = password_verify($submitted_password, $row);
    }
    if(!$password_ok){
        $errors[] = 'Please enter a valid username and password';
    }

    return array($errors, $input);
}

function process_form($input){
    $_SESSION['username'] = $input['username'];

    print 'Welcome to '. $_SESSION['username'];
}
