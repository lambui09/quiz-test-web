<?php
//COL_USER
//COL_NAME
//COL_CLASS
//COL_BIRTHDAY

include_once "../utils/conn.php";
include_once "../check/checkSigned.php";
if (isset($_POST[COL_USER]) && isset($_POST[COL_NAME]) && isset($_POST[COL_CLASS]) && isset($_POST[COL_BIRTHDAY])) {

    if (isAdmin()) {
        $qrUpdate = "
            UPDATE detailuser
            SET
              name = '{$_POST[COL_NAME]}',
              class= '{$_POST[COL_CLASS]}',
              birthday='{$_POST[COL_BIRTHDAY]}'
              WHERE username = '{$_POST[COL_USER]}'
        ";
        $link->query($qrUpdate);
    }
}
$link->close();
header("Location: ../view.php");