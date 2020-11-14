<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(validate()){
        process_form();
    }
}

function process_form(){
    echo $_POST['noodle'];       
    foreach($_POST['sweet'] as $value){
        echo $value;
    }
    echo $_POST['sweet_q'];
}

function validate(){
    if($_POST['sweet_q'] < 1){
        return false;
    }else{
        return true;
    }
}





?>