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
<title>ホスト名表示</title>
</head>
<body>
<h1>ホスト名表示</h1>
<p>Bluemix PHPランタイムのサンプル・コードです</p>
<p>このコンテンツは、ログインしていないと見えないものです。</p>

    
<H1> ホスト：
<?php echo gethostname(); ?>
</H1>
    
<?php include "menu.php"; ?>
</body>
</html>
<?php } ?>
      

