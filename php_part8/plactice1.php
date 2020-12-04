<?php
//演習問題8.12-1
"create table dishes(
    dishes_id INT,
    dishe_name VARCHAR(255),
    price DECIMAL(4, 2),
    is_spicy INT
)";

// INSERT INTO dishes VALUES (1, "Walnut Bun", 1.00, 0);
// INSERT INTO dishes VALUES (2, "Cashew Nuts and White Mushrooms", 4.95, 0);
// INSERT INTO dishes VALUES (3, "DriedMulberries", 3.00, 0);
// INSERT INTO dishes VALUES (4, "Eggplant with Chili Sauce", 6.50, 1);
// INSERT INTO dishes VALUES (5, "Red Bean Bun", 1.00, 0);
// INSERT INTO dishes VALUES (6, "General Tso's Chickin", 5.50, 1);

try{
    $db = new PDO('mysql:host=docker-practice_mysql_1;dbname=plactice','root','pass');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    $sql = "SELECT price FROM dishes ORDER BY price";
    // $sql = "SELECT * FROM dishes WHERE dish_id=?";
    $stmt = $db->query($sql);
    $dishes = $stmt->fetchAll();

    var_dump($stmt);

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


