<?php
require_once "dishes.csv";
//csvファイルをDBに保存する
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
    print $info[0];
}
fclose($fh);

//DBからcsvファイルに書き出し
try{
    $db = new PDO('mysql:host=docker-practice_mysql_1;dbname=restaurant','root','pass');
}catch(PDOException $e){
    print "PDOエラー" . $e->getMessage();
    exit;
}
$fh = fopen('dishes.csv','wb');
$dishes = $db->query('SELECT dish_name, price, is_spicy FROM dishes');
while($row = $dishes->fetch(PDO::FETCH_NUM)){
    fputcsv($fh, $row);
}
fclose($fh);

//完全なcsv出力プログラム
try{
    $db = new PDO('mysql:host=docker-practice_mysql_1;dbname=restaurant','root','pass');
}catch(PDOException $e){
    print "PDOエラー" . $e->getMessage();
    exit;
}
header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="dishes.csv');

$fh = fopen('php://output','wb');
$dishes = $db->query('SELECT dish_name, price, is_spicy FROM dishes');
while($row = $dishes->fetch(PDO::FETCH_NUM)){
    fputcsv($fh, $row);
}



?>