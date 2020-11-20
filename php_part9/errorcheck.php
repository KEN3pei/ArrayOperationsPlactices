<?php
//エラーチェック
//fopenとfclose(falseを返すのはこの２つのタイミング)
try{
    $db = new PDO('mysql:host=docker-practice_mysql_1;dbname=restaurant','root','pass');
}catch(PDOException $e){
    print "PDOエラー" . $e->getMessage();
    exit;
}
$fh = fopen('dishes.txt', 'wb');
if(!$fh){
    print $php_errormsg;
}else{
    $q = $db->query('SELECT dish_name, price FROM dishes');
    while($row = $q->fetch(PDO::FETCH_NUM)){
        fwrite($fh, "the price of $row[0] is $row[1] \n");
    }
    if(!fclose($fh)){
        print $php_errormsg;
    }
}

// file_get_contents,fgets,fgetscsv(同値チェック)
$page = file_get_contents("page-template.html");
if($page === false){
    print $php_errormsg;
}

// file_put_contents(falseを返す場合と-1を返す場合がある)
if(($result === false) || ($result === -1)){
    print $php_errormsg;
}

// 外部から提供されたファイル名の無害化
// postされたdataから / と .. を排除
$user = str_replace('/', '', $_POST['user']);
$user = str_replace('..', '', $_POST['user']);


// realpathを使ってファイル名の無害化
$filename = realpath("/user/local/data/$_POST[user]");
// $_POST[user]に..や/があれば階層が代わりマッチしなくなる
if(('/user/local/data/' === substr($filename, 0, 16)) && (is_readable($filename))){
    print htmlentities($_POST['user']);
    print file_get_contents($filename);
}else{
    print "Invalid user entered";
}
?>