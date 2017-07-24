<?php
session_start();
if (isset($_SESSION["userid"])) {
    print $_SESSION['userid']."さん、ログアウトしました。<br>";
    session_unset ();
}
include "index.php";
?>


