<?php

include_once "./check/checkSigned.php";

if (!isAdmin()) {
    header("Location: /");
    exit(0);
}

if (isset($_GET['id'])) {
    include_once "./utils/conn.php";
    $qrDelete = "
    DELETE 
    FROM questions
    WHERE id='{$_GET['id']}'";
    $link->query($qrDelete);
    $link->close();
}
header("Location: " . $_SERVER["HTTP_REFERER"]);