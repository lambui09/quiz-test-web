<?php

include_once "./check/checkSigned.php";

if (!isAdmin()) {
    header("Location: ./");
    exit(0);
}
include_once "./utils/conn.php";

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/edit.css">
    <title>Thêm sinh viên</title>
</head>
<body>
<?php

include_once "./header.php";
?>
<form class="update" action="./check/checkAddSv.php" method="post">
    <div><b>Thêm sinh viên</b></div>
    <div class="container">
        <label><b>Họ tên</b></label>
        <input type="text" name="<?php echo COL_NAME ?>" autofocus required>
        <label><b>Tên đăng nhập</b></label>
        <input type="text" name="<?php echo COL_USER ?>" required>
        <label><b>Mật khẩu</b></label>
        <input type="password" name="<?php echo COL_PASS ?>" required>

        <label><b>Lớp</b></label>
        <input type="text" name="<?php echo COL_CLASS ?>"  required>
        <label><b>Ngày sinh</b></label>
        <input type="text" name="<?php echo COL_BIRTHDAY ?>" required>
        <input type="submit" value="Thêm"/>
    </div>
</form>
<?php
include_once "./footer.php"
?>
</body>
</html>
