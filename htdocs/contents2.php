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
<title>phpinfo()表示</title>
</head>
<body>
<h1>phpinfo()表示</h1>
<p>Bluemix PHPランタイムのサンプル・コードです</p>
このコンテンツは、ログインしていないと見えないものです。
<?php include "menu.php"; ?>
<br>
<?php phpinfo(); ?>

</body>
</html>
<?php } ?>
      

