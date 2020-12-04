<?php

//演習問題8.12-1
"UPDATE dishes ORDER BY price ";

try{
    $db = new PDO('');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT price FROM dishes ORDER BY price";
    $stmt = $db->query($sql);
    $dishes = $stmt->fetchAll();

    if(count($dishes) == 0){
        print 'No dishes matched';
    }else{
        print '<table>';
        print '"<tr><th>dish Name</th><th>Price</th><th>Spicy?</th></tr>';
        foreach($dishes as $dish){
            print "<tr><td>".
            printf('<tr><td>%s</td><td>$%.02f</td><td>%s</td></tr>',
                htmlentities($dish->dish_name), $dish->price, $dish->is_spicy);
        }
        print '</table>';
    }

}catch(PDOException $e){

    print $e->getMessage();
}


