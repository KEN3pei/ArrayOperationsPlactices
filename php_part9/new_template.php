<?php
//課題9.9-1
$new_template = "new_template.html";
if (is_readable($new_template)){
    $template = file_get_contents($new_template);
    
    if($template === false){
        print $php_errormsg;
    }else{
        $template = str_replace('{page_title}', 'template_file', $template);
        $template = str_replace('{name}', 'kensuke', $template);
    }
}

$result = file_put_contents("new_template.html", $template);
if(($result === false) || ($result === -1)){
    print "Could't save HTML to new_template.html";
}


?>