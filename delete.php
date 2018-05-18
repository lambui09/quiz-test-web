<?php

include_once "./check/checkSigned.php";
if (isset($_GET['id'])) {
    include_once "./utils/conn.php";
    if (isAdmin()) {
        $qrDelete = "
            DELETE 
            FROM details
            WHERE id='{$_GET[COL_ID]}'
        ";
        echo $qrDelete;
        $link->query($qrDelete);
        $link->close();
    }

}
header("Location: " . $_SERVER["HTTP_REFERER"]);