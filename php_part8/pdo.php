<?php

//ORDER BY句
//->ORDER BY price は昇順で並べ替え
//->ORDER BY price DESC で降順
//->ORDER BY price LIMIT 10 で昇順に10行だけ取得

//fetchのモードのdefaultを設定するには、
//クエリごとには、setFetchMode()を使う
//全てに設定したい場合はsetAttribute()を使う

//SQLのワイルドカード
//「_」は一文字、「％」は任意の数の文字
// ->料理名がDから始まる行をすべて取得する
"SELECT * FROM dishes WHERE dish_name LIKE 'D%'";

// ->料理名がfrid Cod、frid Mod、frid Bodなどを取得する
"SELECT * FROM dishes WHERE dish_name LIKE 'frid _od";

// ->ワイルドカードのエスケープ 50% offを探したい場合
"SELECT * FROM dishes WHERE dish_name LIKE '%50\% off%'";

//クエリで安全にsqlを使う方法
//PDOの「quote()」とPHPの「strtr()」を使う
//以下ようにすればsql文で使うときに無害化できる
$dish = $db->quote($_POST['dfgh']);
$dish = strtr($dish, array('_' => '\_', '%' => '\%'));
//UPDATEするときに問題になるクエリ
//もしPOST＝％だったらすべての値がprice=1になってしまう
$stmt = $db->prepare("UPDATE dishes set ptice=1 WHERE dish_name LIKE '?'");
$stmt->execute(array($_POST['dfgh']));




