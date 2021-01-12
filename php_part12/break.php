<?php
$prices = array(5.95, 3.00, 12.50);
$total_price = 0;
$tax_rate = 1.08;

foreach($prices as $price){
    // error_log("[before: $total_price]");
    $total_price = $price * $tax_rate;
    // error_log("[after: $total_price]");
}

printf('Total price (with tax): $%.2f', $total_price);

function niceExceptionHandler($ex){
    print "未補足エラーをキャッチしました";
    error_log("{$ex->getMessage()} in {$ex->fetFile()} @ {$ex->getLine()}");
    error_log($ex->getTranceAsString());
}

// throwされた例外は最終的にset_exception_handlerで指定された例外処理にたどり着く
set_exception_handler('niceExceptionHandler');

print "I`m about to connect to a make up, pretend, broken, database\n";

$db = new PDO('garbage:this is oviously not going to work!');

print "this is not going to get pritend";