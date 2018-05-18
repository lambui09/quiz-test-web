<?php

include_once "const.php";

$link = new mysqli(HOST, USER_NAME, PASS, DB_NAME);
if ($link->errno) {
    echo $link->error;
} else {
    $link->query("set NAMES 'utf8'");
}