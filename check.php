<?php
include_once "./utils/conn.php";
include_once "./header.php";
$diem = 0;
foreach ($_POST as $id => $ans) {
    $qr = "select * from questions WHERE id='{$id}' AND dapan = '{$ans}'";
    if ($link->query($qr)->num_rows > 0) {
        $diem += 10;
    }
}
?>
    <div class="container">
        <span><?php echo "Điểm của bạn là : " . $diem;?></span>
    </div>
    <link rel="stylesheet" href="./css/result.css">
<?php

$qrUpdate = "SELECT timestart FROM details WHERE username='{$_SESSION[USER]}' AND isSubmit=FALSE ORDER BY time DESC";
$result = $link->query($qrUpdate);
if ($result->num_rows > 0 && $row = $result->fetch_array()) {
    $timeStart = $row[COL_TIME_START];
    $nowTime = new DateTime();
    $time = $nowTime->getTimestamp() - $timeStart;
    if ($time > MAX_TIME) {
        $diem = 0;
    }
    $qrUpdate = "UPDATE details SET isSubmit = true, score = $diem, time='{$time}' WHERE username='{$_SESSION[USER]}' AND isSubmit=FALSE";
    $link->query($qrUpdate);
} else {
    echo "err";
}
$link->close();