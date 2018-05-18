<?php
//COL_USER
//COL_NAME
//COL_CLASS
//COL_BIRTHDAY

include_once "../utils/conn.php";
include_once "../check/checkSigned.php";
if (isset($_POST[COL_NAME]) && isset($_POST[COL_USER]) && isset($_POST[COL_PASS]) && isset($_POST[COL_CLASS]) && isset($_POST[COL_BIRTHDAY])) {

    if (isAdmin()) {
        $qrSeach = "SELECT username
        FROM account
        WHERE username='{$_POST[COL_USER]}'";
        $result = $link->query($qrSeach);
        if ($result->num_rows > 0) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        } else {
            $qrAdd = "
                INSERT INTO account
                VALUES ('{$_POST[COL_USER]}', '{$_POST[COL_PASS]}', FALSE )
            ";
            $link->query($qrAdd);

            $qrAdd = "
                INSERT INTO detailuser(username, name, class, birthday)
                VALUES ('{$_POST[COL_USER]}', '{$_POST[COL_NAME]}', '{$_POST[COL_CLASS]}', '{$_POST[COL_BIRTHDAY]}');
            ";
            $link->query($qrAdd);
            header("Location: ../");
        }

    }
}
$link->close();
header("Location: ../view.php");