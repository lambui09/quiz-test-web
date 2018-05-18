<?php

include_once "./checkSigned.php";

if (!isAdmin()) {
    header("Location: ./");
    exit(0);
}
if (isset($_POST['noidung']) && isset($_POST['answer']) && isset($_POST['qs']) && isset($_POST['a']) && isset($_POST['b']) && isset($_POST['c']) && isset($_POST['d'])) {
    include_once "../utils/conn.php";
    $qrUpdate = "
    UPDATE questions
    SET noidung='{$_POST['noidung']}',
    a = '{$_POST['a']}',
    b = '{$_POST['b']}',
    c = '{$_POST['c']}',
    d = '{$_POST['d']}',
    dapan = '{$_POST['answer']}'
    WHERE id='{$_POST['qs']}'
    
    ";
    $link->query($qrUpdate);
    $link->close();
}
header("Location: ../questions.php");