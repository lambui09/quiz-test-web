<?php

include_once "./check/checkSigned.php";

if (!isAdmin()) {
    header("Location: /");
    exit(0);
}
if (isset($_GET['id'])) {
    include_once "./utils/conn.php";
    $qrQuestion = "
        SELECT *
        FROM questions
        WHERE id='{$_GET['id']}'";
    //        echo $qrQuestions;
    $result = $link->query($qrQuestion);
    $row = $result->fetch_array();


    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="./css/edit.css">
        <title>Edit</title>
    </head>
    <body>
    <?php

    include_once "./header.php";
    ?>
    <form class="updateQs" action="./check/checkEditQs.php" method="post">
        <div><b>Chỉnh sửa câu hỏi</b></div>
        <div class="container">
            <textarea name="noidung" rows="5"><?php echo $row[COL_CONTENT] ?></textarea>
            <ul>
                <li>
                    <input id="<?php echo $row[COL_ID] . A ?>" type="radio"
                           name="answer"
                           value="a" <?php if ($row[COL_ANSWER] == 'a')
                        echo "checked" ?>>
                    <input type="text" name="a" value="<?php echo $row[COL_A] ?>">
                </li>
                <li>
                    <input id="<?php echo $row[COL_ID] . B ?>" type="radio"
                           name="answer"
                           value="b" <?php if ($row[COL_ANSWER] == 'b')
                        echo "checked" ?>>
                    <input type="text" name="b" value="<?php echo $row[COL_B] ?>">
                </li>
                <li>
                    <input id="<?php echo $row[COL_ID] . C ?>" type="radio"
                           name="answer"
                           value="c" <?php if ($row[COL_ANSWER] == 'c')
                        echo "checked" ?>>
                    <input type="text" name="c" value="<?php echo $row[COL_C] ?>">
                </li>
                <li>
                    <input id="<?php echo $row[COL_ID] . D ?>" type="radio"
                           name="answer"
                           value="d" <?php if ($row[COL_ANSWER] == 'd')
                        echo "checked" ?>>
                    <input type="text" name="d" value="<?php echo $row[COL_D] ?>">
                </li>
            </ul>
            <input type="hidden" name="qs" value="<?php echo $row[COL_ID] ?>">
            <input type="submit">
        </div>
    </form>
    <?php
    include_once "./footer.php"
    ?>
    </body>
    </html>
    <?php
}
?>


