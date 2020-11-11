<?php
foreach(file("people.txt") as $line){
    $line = trim($line);
    $info = explode('|', $line);
    //mail作成リンク生成
    print '<li><a href="mailto:' . $info[0] .'">' . $info[1]. '</a></li><br>';
}

?>