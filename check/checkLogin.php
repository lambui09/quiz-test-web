<?php

include_once "checkSigned.php";
include_once "../utils/conn.php";

if (isSigned()) {
    if (isset($_POST['next'])) {
        header("Location " . $_POST['next']);
    } else {
        header("Location ../");
    }
} else {
    if (isset($_POST['user']) && strlen($_POST['user']) > 0 && isset($_POST['pass']) && strlen($_POST['pass']) > 0) {
        $qrLogin = "SELECT isAdmin FROM account WHERE username='{$_POST['user']}' and  PASSWORD ='{$_POST['pass']}'";
        $result = $link->query($qrLogin);
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_array()) {
                if ($row[COL_IS_ADMIN] == 1) {
                    $_SESSION[TYPE] = ADMIN_TYPE;
                } else {
                    $_SESSION[TYPE] = USER_TYPE;
                }

                $_SESSION[USER] = $_POST['user'];
            }

            $next = '../';
            if (isset($_POST['next'])) {
                $next = $_POST['next'];
            }
            header("Location: " . $next);
        } else{
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}


$link->close();