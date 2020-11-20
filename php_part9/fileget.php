<?php
// require_once "page-template.html";

$page = file_get_contents("page-template.html");
$page = str_replace('{page_title}', 'welcome', $page);
if(date('H') >= 12){
    $page = str_replace('{color}', 'blue', $page);
}else{
    $page = str_replace('{color}', 'green', $page);
}
echo $page;

// fileへの書き込み処理
file_put_contents("page-template.html", $page);

//読み込みパーミッションの検査
$template_file = "page-template.html";
if (is_readable($template_file)){
    $template = file_get_contents($template_file);
}
//書き込みパーミッションの検査
$log_file = '/var/log/users.log';
if(is_writable($log_file)){
    $fh = fopen($log_file, 'ab');
    fwrite();
    fclose();
}



?>