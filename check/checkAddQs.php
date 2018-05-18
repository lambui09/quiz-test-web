<?php

include_once "./checkSigned.php";

if (!isAdmin()) {
    header("Location: ../");
    exit(0);
}
if (isset($_POST['noidung']) && isset($_POST['answer']) && isset($_POST['a']) && isset($_POST['b']) && isset($_POST['c']) && isset($_POST['d'])) {
    include_once "../utils/conn.php";
    $qrAdd = "
    INSERT INTO questions (noidung, a, b, c, d, dapan)
    VALUES
    ('{$_POST['noidung']}', '{$_POST['a']}', '{$_POST['b']}', '{$_POST['c']}', '{$_POST['d']}', '{$_POST['answer']}')
    ";
//    echo $qrAdd;
    $link->query($qrAdd);
    $link->close();
}
header("Location: ../questions.php");