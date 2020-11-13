<?php
require_once "dishes.csv";

try{
    $db = new PDO('mysql:host=docker-practice_mysql_1;dbname=restaurant','root','pass');
}catch(PDOException $e){
    echo "PDOエラー" . $e->getMessage();
    exit();
}
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$fh = fopen('dishes.csv','rb');
$stmt = $db->prepare('INSERT INTO dishes (dish_name, price, is_spicy) VALUES (?,?,?)');
while((!feof($fh)) && ($info = fgetcsv($fh))){
    $stmt->execute($info);
    echo $info[0];
}
fclose($fh);
?>