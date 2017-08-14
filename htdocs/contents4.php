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
<title>ユーザー提供サービス連携</title>
</head>
<body>
<h1>ユーザー提供サービス連携</h1>
<p>Bluemix PHPランタイムのサンプル・コードです。このコンテンツは、ログインしていないと見えないものです。</p>
<p>この計算処理は、python で作られたRESTサービスのコンテナで計算され、結果を返します。</p>

<form action="action_calc.php" method="post">
  入力値 A: <input type="text" name="val_a" /><br>
  入力値 B: <input type="text" name="val_b" /><br>
<input type="submit" value="実行" /><br>
</form>   
    
<?php include "menu.php"; ?>
</body>
</html>
<?php } ?>
      

