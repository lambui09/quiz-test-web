<?php

include_once "./check/checkSigned.php";

if (!isAdmin()) {
    header("Location: /");
    exit(0);
} include_once "./utils/conn.php";
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="./css/edit.css">
        <title>Thêm câu hỏi</title>
    </head>
    <body>
    <?php

    include_once "./header.php";
    ?>
<form class="updateQs" action="./check/checkAddQs.php" method="post">
    <div><b>Thêm câu hỏi</b></div>
    <div class="container">
        <textarea rows="5" name="noidung" placeholder="Nội dung câu hỏi" required></textarea>
        <ul>
            <li>
                <input type="radio" type="radio" name="answer" value="a" checked>
                <input type="text" name="a" placeholder="Đáp án A" required>
            </li>
            <li>
                <input type="radio" name="answer" value="b">
                <input type="text" name="b" placeholder="Đáp án B" required>
            </li>
            <li>
                <input type="radio" name="answer" value="c">
                <input type="text" name="c" placeholder="Đáp án C" required>
            </li>
            <li>
                <input type="radio" name="answer" value="d">
                <input type="text" name="d" placeholder="Đáp án D" required>
            </li>
        </ul>
        <input type="submit">
    </div>
</form>
<?php
include_once "./footer.php"
?>
</body>
</html>
