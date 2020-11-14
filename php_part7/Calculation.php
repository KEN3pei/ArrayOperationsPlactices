<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $post = $_POST['calculation'];
    echo $post();
}

function plus(){
    return $_POST['num1'] + $_POST['num2'];
}

function minus(){
    return $_POST['num1'] - $_POST['num2'];
}

function multi(){
    return $_POST['num1'] * $_POST['num2'];
}

function divided(){
    return $_POST['num1'] / $_POST['num2'];
}

?>