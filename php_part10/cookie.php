<?php
session_start();
//クッキーはPHPエンジンがクライアント側に送信してそれに対して返信されることで$_COOKIEに格納される
//セットしたクッキーを送り返せるのは、デフォルトでは同じ階層かそれ以下へのリクエストのみ

//クッキーの有効期限設定
//一時間後
// setcookie('user_id', 'ralph', time() + 60 * 60);
//１日後
// setcookie('user_id', 'ralph', time() + 60 * 60 * 24);

//2019年10月01の正午まで
// $d = new DateTime("2019-10-01 12:00:00");
// setcookie('user_id', 'ralph', $d->format('U'));

//パス、ドメイン、セキュリティ関連のパラメータ２つ
//パス
// '/'とすることでサーバへの全てのリクエストでこのクッキーを送り返すことになる
// setcookie('user_id', 'ralph', 0, '/');

//ドメイン
//デフォルトでは、セットしたのと同じホストへのリクエストでしかそのクッキーは送り返されない
//.example.comで終わる全てのサーバ('/'のため)へのリクエストでセットしたクッキーが取得できる
// setcookie('user_id', 'ralph', 0, '/', '.example.com');

//セキュリティ関連のパラメータ２つ
//httpsで始まるurlでのみクッキーを返す
// setcookie('user_id', 'ralph', 0, '/', '.example.com', true);
//HTTP通信専用クッキーとする。
// setcookie('user_id', 'ralph', 0, '/', '.example.com', true, true);

// 安全なパスやドメインの制限のない通信の例
// setcookie('user_id', 'ralph', 0, null, null, true, true);

//クッキーの削除
// setcookie('user_id', '');

//【session】
// PHPSESSIDというサーバ側から見てwebクライアントを一意に識別できるIDを持つ
// これをPHPエンジン側で指定してwebクライアントに送り返してもらうことで一意な通信ができるようになる

//最初のアクセス時にはsession値はないのでSESSIONをセットしてwebクライアントに返す。
//またPHPSESSIDに新しいidもつけて送る
//そしてリクエストの最後に適切なidに紐付けられてサーバ上のファイルに保存される

//二回目のアクセスでは、session_startがidがあるのを確認してそれに紐付いたsession情報のあるファイルをロードする。
if(isset($_SESSION['count'])){
    $_SESSION['count'] = $_SESSION['count'] + 1;
}else{
    $_SESSION['count'] = 1;
}
print "セッション回数 = " . $_SESSION['count'];

// 24分に１回アクセスしていればセッションは保持される。
// session.gc_maxlifetimeでsessionのアイドル時間を制御できる
// ini_setで制御する方法(session_startの前に記述)
ini_set('session.gc_maxlifetime', 600); //600秒(10分)
session_start();

// 期限が切れたsessionは1%の確率で削除される
// この確率を制御する方法
ini_set('session.gc_probability', 100); //100%削除
session_start();

//setcookie()とsession_start()が最初に来る理由
// サーバからwebクライアントにhtmlを送る時は見えないヘッダが先頭にある。
// setcookie()らはこれを作成しているためこれより前に出力があるといけない
// ただし出力バッファリングをonにすることで設定されたヘッダが出力されるまで他の出力を待機させることができるため可能になる

?>
<!DOCTYPE html>
<html lang="ja">
    <head><title>cookie</title></head>
    <body>
        cookie
    </body>
</html>