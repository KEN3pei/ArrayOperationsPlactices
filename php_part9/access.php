<?php
// foreach(file("people.txt") as $line){
//     $line = trim($line);
//     $info = explode('|', $line);
//     //mail作成リンク生成
//     print '<li><a href="mailto:' . $info[0] .'">' . $info[1]. '</a></li><br>';
// }

$fh = fopen('people.txt', 'rb');
// 取得したファイルの現在位置が末尾に達していない&&ファイルの行の情報が取得できている
while((!feof($fh)) && ($line = fgets($fh))){
    $line = trim($line);
    $info = explode('|', $line);
    print '<li><a href="mailto:' . $info[0] .'">' . $info[1]. '</a></li><br>';
}
fclose($fh); //ファイルへの接続解除

?>