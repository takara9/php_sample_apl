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
<title>コンテンツ１</title>
</head>
<body>
<h1>コンテンツ１</h1>
<p>Bluemix PHPランタイムのサンプル・コードです</p>
<p>このコンテンツは、ログインしていないと見えないものです。</p>

<table border="1">
<tr>
<th width="100" align="center">ID</th>
<th width="200">NAME</th>
</tr>

<?php
include "cfenv.php";
$vcap = new Vcap('ClearDB Managed MySQL Database-bn');
$dsn = 'mysql:host='.$vcap->host.";port=".$vcap->port.";dbname=testdb";

$ops = array(
    PDO::MYSQL_ATTR_SSL_CA => __DIR__ ."/". $vcap->ca_pem_filename,
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
);

$dbh = new PDO($dsn, $vcap->user, $vcap->pass, $ops);

foreach($dbh->query('SELECT id, name FROM animals') as $row) {
    print "<tr>";
    print "<td align=\"center\">".$row['id']."</td>";
    print "<td>".$row['name']."</td>";
    print "</tr>";
}
$dbh = null;
?>
</table>

<?php include "menu.php"; ?>
</body>
</html>
<?php } ?>
      

