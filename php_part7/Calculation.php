<?php
//http://localhost/php_part7/Calculation.php
// 7.8演習問題3
$defaults = array("plus" => "加算",
                    "minus" => "減算",
                    "multi" => "乗算",
                    "divided" => "除算");

function show_form(){
    $select = generate_option($GLOBALS['defaults']);
    print
    "<form method='POST' action=" .$_SERVER['PHP_SELF']. ">
        <input type='text' name='num1'>
        <input type='text' name='num2'>
        <br/>
        計算方法: <select name='calculation'>"
        . $select .
        "</select>
        <br/>
        <input type='submit' name='submit' value='算出'>
    </form>";
}

function generate_option($options){
    $html = "";
    foreach($options as $key => $option){
        $html .= "<option value=" .$key. ">" .
                 $option
                 . "</option>";
    }
    return $html;
}

function plus($num1, $num2){
    return $num1 + $num2;
}

function minus($num1, $num2){
    return $num1 - $num2;
}

function multi($num1, $num2){
    return $num1 * $num2;
}

function divided($num1, $num2){
    if($num2 == 0){
        return "num2 is zero please reset";
    }
    return $num1 / $num2;
}

function validate(){

    // 演習問題12-6.3(答え)
    // 出力バッファリングを有効にする
    ob_start();
    // サブミットされたデータをすべてダンプする
    var_dump($_POST);
    // 生成された「出力」を取得する
    $output = ob_get_contents();
    // 出力バッファリングを無効にする
    ob_end_clean();
    // 変数ダンプをエラーログに送る
    error_log($output);

    $input['num1'] = filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_FLOAT);
    if(is_null($input['num1']) || ($input['num1'] === false)){
        echo "num1 is validated";
        return false;
    }
    $input['num2'] = filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_FLOAT);
    if(is_null($input['num2']) || ($input['num2'] === false)){
        echo "num2 is validated";
        return false;
    }
    if(!array_key_exists(htmlentities($_POST['calculation']), $GLOBALS['defaults'])){
        echo "array_key_exists is validated";
        return false;
    }
    // 演習問題12-6.3
    // error_log(" form1 = {$input['num1']}, form2 = {$input['num2']}, calculation = {$_POST['calculation']}");
    return true;
}

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="utf-8"/>
    <title>calculation</title>
    </head>
    <body>
        <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // echo "ncisuvkzle";
            if(validate()){
                $post = htmlentities($_POST['calculation']);
                $num1 = htmlentities($_POST['num1']);
                $num2 = htmlentities($_POST['num2']);

                if($post == "plus"){
                    print plus($num1, $num2);
                }elseif($post == "minus"){
                    print minus($num1, $num2);
                }elseif($post == "multi"){
                    print multi($num1, $num2);
                }elseif($post == "divided"){
                    print divided($num1, $num2);
                }
            }
        }else{
            show_form();
        }
        ?>
        <!-- mac -> cmd+クリック
             windows -> ctrl+クリック -->
    </body>
</html>