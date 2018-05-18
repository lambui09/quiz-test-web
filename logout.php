<?php
include_once "./check/checkSigned.php";

if (isSigned()) {
    unset($_SESSION[TYPE]);
    unset($_SESSION[USER]);
}
header("Location: ./");