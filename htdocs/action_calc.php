<?php
session_start();
if (! isset($_SESSION["userid"])) {
    // 認証がなければログインページに飛ばす
    include "login.php";
} else {
    // 認証後に表示するコンテンツ
    include "rest_if.php";

    $param['username'] = "takara";
    $param['password'] = "hogehoge";

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>計算結果表示ページ</title>
</head>
<body>

<title>ユーザー提供サービス連携 計算結果表示ページ</title>
<p>Bluemix PHPランタイムのサンプル・コードです。このコンテンツは、ログインしていないと見えないものです。</p>
<p>この計算処理は、python で作られたRESTサービスのコンテナで計算され、結果を返します。</p>



<?php
if (strlen($_POST['val_a']) > 0 and strlen($_POST['val_b']) > 0) {
    $_SESSION["val_a"] =  $_POST['val_a'];
    $_SESSION["val_b"] =  $_POST['val_b'];

    $param['a'] = $_SESSION["val_a"];
    $param['b'] = $_SESSION["val_b"];
    $post['json'] = json_encode($param);

    $url = "https://pycalcxx.mybluemix.net/calc";
    //$url = "http://localhost:5000/";

    $reply = curl_post($url,$post);
    $result = json_decode($reply);
    // print $result->{'ans'}."\n";

?>

<br>
値A : <?php echo $_SESSION["val_a"] ?><br>
値B : <?php echo $_SESSION["val_b"] ?><br>
結果: <?php echo $result->{'ans'} ?><br>
<br>
    
<?php
    include "menu.php";
} else {
    print "１文字以上のインプットをお願いします。<br>";
    print "<a href='contents4.php'>ログインへ戻る</a><br>";
}
?>

</body>
</html>
<?php } ?>
