<?php
session_start();
if (! isset($_SESSION["userid"])) {
    // 認証がなければログインページに飛ばす
    include "login.php";
} else {
    // 認証後に表示するコンテンツ
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
?>

<br>
値A : <?php $_POST['val_a']?><br>
値B : <?php $_POST['val_b']?><br>
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

