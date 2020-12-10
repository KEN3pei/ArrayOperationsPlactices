<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//演習問題8.12-1

try{
    $db = new PDO('mysql:host=docker-practice_mysql_1;dbname=plactice','root','pass');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    $sql = "SELECT price FROM dishes ORDER BY price";
    // $sql = "SELECT * FROM dishes WHERE dish_id=?";
    $stmt = $db->query($sql);
    $dishes = $stmt->fetchAll();

    // var_dump($stmt);

    if(count($dishes) == 0){
        print 'No dishes matched';
    }else{
        print '<table>';
        print '<tr><th>Price</th></tr>';
        foreach($dishes as $dish){
            printf('<tr><td>$%.02f</td></tr>',
                htmlentities($dish->price));
        }
        print '</table>';
    }

}catch(PDOException $e){

    print $e->getMessage();
}


