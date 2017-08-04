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
$vcap = new Cfenv();
$vcap->byServiceName('dashDB');


$dsn = "ibm:DRIVER={IBM DB2 ODBC DRIVER}".
       ";DATABASE=".$vcap->dbname.
       ";HOSTNAME=".$vcap->host.
       ";PORT=50001".
       ";PROTOCOL=TCPIP".
       ";SECURITY=SSL;";

$dbh = new PDO($dsn,$vcap->user,$vcap->pass);

foreach($dbh->query('SELECT id, name FROM animals') as $row) {
print "<tr>";
    print "<td align=\"center\">".$row[0]."</td>";
    print "<td>".$row[1]."</td>";
print "</tr>";
}
$dbh = null;
?>
</table>

<?php include "menu.php"; ?>
</body>
</html>
<?php } ?>
      

