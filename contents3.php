<?php include "store_encrypter.php"; ?>

<?php

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
<title>コンテンツ３</title>
</head>
<body>
<h1>コンテンツ３</h1>
<p>Bluemix PHPランタイムのサンプル・コードです</p>
<p>このコンテンツは、ログインしていないと見えないものです。</p>

    
<H1> ホスト：
<?php echo gethostname(); ?>
</H1>
    
<?php include "menu.php"; ?>
</body>
</html>
<?php } ?>
      

