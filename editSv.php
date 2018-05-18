<?php

include_once "./check/checkSigned.php";

if (!isAdmin() || !isset($_GET['username'])) {
    header("Location: /");
    exit(0);
}
include_once "./utils/conn.php";
$qrUser = "
    SELECT username, name, class, birthday FROM detailuser
    WHERE username = '{$_GET['username']}'
";
$result = $link->query($qrUser);
if ($result->num_rows == 0) {
    echo "Không tìm thấy user";
    $link->close();
    exit(0);
}
$row = $result->fetch_array();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/edit.css">
    <title>Edit</title>
</head>
<body>
<?php

include_once "./header.php";
?>
<form class="update" action="./check/checkEditSv.php" method="post">
    <div><b>Chỉnh sửa thông tin sinh viên</b></div>
    <div class="container">
        <input type="hidden" name="<?php echo COL_USER ?>" value="<?php echo $row[COL_USER] ?>">
        <label><b>Họ tên</b></label>
        <input type="text" name="<?php echo COL_NAME ?>" value="<?php echo $row[COL_NAME] ?>" autofocus required>

        <label><b>Lớp</b></label>
        <input type="text" name="<?php echo COL_CLASS ?>" value="<?php echo $row[COL_CLASS] ?>" required>
        <label><b>Ngày sinh</b></label>
        <input type="text" name="<?php echo COL_BIRTHDAY ?>" value="<?php echo $row[COL_BIRTHDAY] ?>" required>
        <input type="submit" value="Cập nhật"/>
    </div>
</form>
<?php
include_once "./footer.php"
?>
</body>
</html>
