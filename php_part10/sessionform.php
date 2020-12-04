<?php
session_start();

require "formhelper.php";
$main_dishes = array('cute' => 'Braised Sea Cucumber',
                     'stomach' => "Ssuteen Pig's ",
                     'tripe' => 'Ssuteen Tripe with Wine Sauce',
                     'taro' => 'Stewed Pork with Taro',
                     'Giblets' => 'Baled Giblets with Salt',
                     'abalone' => 'Abalone with Marrow' );

if(isset($_SESSION['order']) && (count($_SESSION['order']) > 0)){
    print '<ul>';
    foreach($_SESSION['order'] as $order){
        $dish_name = $main_dishes[$order['dish']];
        print "<li>$order[quentity] of $dish_name</li>";
    }
    print '</ul>';
}else{
    print "You haven't ordered anything";
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
    Dish: {$form->select($GLOBALS['main_dishes'],['name' => 'dish'])} <br/>
    Quentity: {$form->input('text',['name' => 'quentity'])} <br/>
    {$form->input('submit',['value' => 'Order'])}
    </form>";         
}

function validate(){
    $input = array();
    $errors = array();

    $input['dish'] = $_POST['dish'] ?? '';
    if(!array_key_exists($input['dish'], $GLOBALS['main_dishes'])){
        $errors[] = 'Please select a valid dish item';
    }
    $input['quentity'] = filter_input(INPUT_POST, 'quentity', FILTER_VALIDATE_INT,
                            array('options' => array('min_range' => 1)));
    if(($input['quentity'] == false) || ($input['quentity'] == null)){
        $errors[] = 'Please enter quentity';
    }
    return array($errors, $input);
}

function process_form($input){
    $_SESSION['order'][] = array('dish' => $input['dish'],
                                 'quentity' => $input['quentity']);

    print 'thank you for order';
}
