<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログインページ</title>
</head>
<body>

<h1>ログインページ</h1>

<?php include_once "store_encrypter.php"; ?>

<?php
if (isset($_SESSION["userid"])) {
   print $_SESSION['userid']."さん、";
   print "既にログイン済みです。<br>";
   include "menu.php";
} else {
?>
<form action="action_login.php" method="post">
  ユーザーID: <input type="text" name="userid" /><br>
  パスワード: <input type="password" name="passwd" /><br>
<input type="submit" value="ログイン" /><br>
</form>   

<?php
}
?>

</body>
</html>

