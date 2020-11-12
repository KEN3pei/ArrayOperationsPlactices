<?php
error_reporting(E_ALL);
// arraypractice.php

$array = [
    "New York" => ["NY", 8175133],
    "Los Angeles" => ["CA", 3792621],
    "Chicago" => ["IL", 2695598],
    "Houston" => ["TX", 2100263],
    "Philadelphia" => ["PA", 1526006],
    "Phoenix" => ["AZ", 1445632],
    "San Antonio" => ["TX", 1327407],
    "San Diego" => ["CA", 1307402],
    "Dallas" => ["TX", 1197816],
    "San Joes" => ["CA", 945942]
];

echo "都市名順";
ksort($array);
echo "<table border=1><tr><th>都市</th><th>州</th><th>人口</th></tr>";
    $total = 0;
    foreach($array as $key => $value){
        echo "<tr><td>" . $key . "</td>
                <td>" . $value[0] . "</td>
                <td>" . $value[1] . "</td></tr>";
        $total += $value[1];
    }
echo "<tr><td>合計</td><td></td><td>" . $total . "</td></tr></table>";

foreach ($array as $key => $value) {
    $sort[$key] = $value[1];
}
array_multisort($sort, SORT_DESC, $array);
echo "人口順";
echo "<table border=1><tr><th>都市</th><th>州</th><th>人口</th></tr>";
    $total = 0;
    foreach($array as $key => $value){
        echo "<tr><td>" . $key . "</td>
                <td>" . $value[0] . "</td>
                <td>" . $value[1] . "</td></tr>";
        $total += $value[1];
    }
echo "<tr><td>合計</td><td></td><td>" . $total . "</td></tr></table>";

foreach ($array as $key => $value) {
    $states[] = $value[0];
}

$unique = array_unique($states);
foreach($unique as $value){
    $result[$value] = 0;
}
// var_dump($result);
foreach($states as $state){
    foreach ($array as $key => $value){
        if($state == $value[0]){
            $result[$value[0]] += $value[1];
            unset($array[$key]);
        }
    }
}
// var_dump($result);
echo "州ごと";
echo "<table border=1><tr><th>州</th><th>人口</th></tr>";
    $total = 0;
    foreach($result as $key => $value){
        echo "<tr><td>" . $key . "</td>
                <td>" . $value . "</td></tr>";
        $total += $value;
    }
echo "<tr><td>合計</td><td>" . $total . "</td></tr></table>";


?>