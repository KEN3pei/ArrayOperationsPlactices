<?php

// $_POST[noodle] = barbecued pork
// $_POST[sweet] = [puff, ricemeat]
// $_POST[sweet_q] = 4
// $_POST[submit] = Order"

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    process_form();
}

function process_form(){
    print htmlentities($_POST['noodle']) . "<br/>";    
    foreach($_POST['sweet'] as $value){
        print htmlentities($value) . "<br/>";
    }
    print htmlentities($_POST['sweet_q']);
}




?>