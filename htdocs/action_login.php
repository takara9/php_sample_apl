
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログインページ</title>
</head>
<body>

<h1>Bluemix PHPランタイムで開発するサンプルPHPです</h1>

<?php
session_start();

if (strlen($_POST['userid']) > 0 and strlen($_POST['passwd']) > 0) {
    $_SESSION["userid"] =  $_POST['userid'];
    $_SESSION["passwd"] =  $_POST['passwd'];
    print "ログインに成功しました。<br>";
    print $_POST['userid']."さん、ようこそ<br>";
    include "menu.php";
    
} else {
    print "１文字以上のインプットをお願いします。<br>";
    print "<a href='login.php'>ログインへ戻る</a><br>";
}

if (isset($_SESSION["count"])) {
   $_SESSION["count"]++;
} else {
  $_SESSION["count"] = 1;
}

?>

</body>
</html>

