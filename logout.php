<?php include "store_encrypter.php"; ?>

<?php

if (isset($_SESSION["userid"])) {
    print $_SESSION['userid']."さん、ログアウトしました。<br>";
    session_unset ();
}
include "index.php";
?>


