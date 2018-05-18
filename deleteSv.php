<?php

include_once "./check/checkSigned.php";

if (!isAdmin() || !isset($_GET['username'])) {
    header("Location: /");
    exit(0);
}
include_once "./utils/conn.php";
$qrDeleteUser = "
    DELETE 
    FROM details
    WHERE username='{$_GET['username']}'
";
$link->query($qrDeleteUser);

$qrDeleteUser = "
    DELETE 
    FROM account
    WHERE username='{$_GET['username']}'
";
$link->query($qrDeleteUser);

$qrDeleteUser = "
    DELETE 
    FROM detailuser
    WHERE username='{$_GET['username']}'
";
$link->query($qrDeleteUser);

$link->close();
header("Location: " . $_SERVER["HTTP_REFERER"]);