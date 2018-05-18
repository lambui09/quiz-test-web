<?php
include_once "./check/checkSigned.php";
if (!isAdmin()) {
    header("Location: ./");
    exit(0);
}
?>
<html>
<head>
    <title>Câu hỏi</title>
    <link rel="stylesheet" href="./css/view.css">
</head>
<body>
<?php
include_once "./header.php";
include_once "./utils/conn.php";
?>
<div class="container">
    <?php
    $offset = 0;

    $qrCount = "SELECT COUNT(*) FROM questions";
    $result = $link->query($qrCount);
    $max = $result->fetch_array()[0];
    $max = floor(($max - 1) / OFFSET_QUESTION);

    if (isset($_GET['offset'])) {
        $offset = $_GET['offset'];

        if ($offset > $max) {
            $offset = $max;
        }
        if ($offset < 0) {
            $offset = 0;
        }

    }
    $begin = $offset * OFFSET_QUESTION;

    $qrQuestions = "
        SELECT *
        FROM questions
        LIMIT {$begin}, " . OFFSET_QUESTION;
    //        echo $qrQuestions;
    $result = $link->query($qrQuestions);
    ?>
    <a class='add' href='./addQs.php'><input type='button' value='+'></a>
    <div class="table-panel">
        <table>
            <caption>Câu hỏi</caption>
            <thead>
            <tr>
                <th>Nội dung</th>
                <th>Đáp án</th>
                <td>Chỉnh sửa</td>
                <td>Xóa</td>
            </tr>
            </thead>
            <tbody>
            <?php
            $index = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_array()) {
                    $index++;
                    ?>
                    <tr>
                        <td class="left">
                            <span><?php echo $row[COL_CONTENT] ?></span>
                        </td>
                        <td class="left">
                            <ul>
                                <li>
                                    <input id="<?php echo $row[COL_ID] . A ?>" type="radio"
                                           name="<?php echo $row[COL_ID] ?>"
                                           value="a" <?php if ($row[COL_ANSWER] == 'a')
                                        echo "checked" ?>>
                                    <label
                                        for="<?php echo $row[COL_ID] . A ?>"><?php echo A . "." . $row[COL_A] ?></label>
                                </li>
                                <li>
                                    <input id="<?php echo $row[COL_ID] . B ?>" type="radio"
                                           name="<?php echo $row[COL_ID] ?>"
                                           value="b" <?php if ($row[COL_ANSWER] == 'b')
                                        echo "checked" ?>>
                                    <label
                                        for="<?php echo $row[COL_ID] . B ?>"><?php echo B . "." . $row[COL_B] ?></label>
                                </li>
                                <li>
                                    <input id="<?php echo $row[COL_ID] . C ?>" type="radio"
                                           name="<?php echo $row[COL_ID] ?>"
                                           value="c" <?php if ($row[COL_ANSWER] == 'c')
                                        echo "checked" ?>>
                                    <label
                                        for="<?php echo $row[COL_ID] . C ?>"><?php echo C . "." . $row[COL_C] ?></label>
                                </li>
                                <li>
                                    <input id="<?php echo $row[COL_ID] . D ?>" type="radio"
                                           name="<?php echo $row[COL_ID] ?>"
                                           value="d" <?php if ($row[COL_ANSWER] == 'd')
                                        echo "checked" ?>>
                                    <label
                                        for="<?php echo $row[COL_ID] . D ?>"><?php echo D . "." . $row[COL_D] ?></label>
                                </li>
                            </ul>
                        </td>
                        <td><a href='./editQs.php?id=<?php echo $row[COL_ID] ?>'>✍</a></td>
                        <td><a href='./deleteQs.php?id=<?php echo $row[COL_ID] ?>'>❌</a></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td>Khong co data</td></tr>";
            }
            $link->close();
            ?>
            </tbody>
        </table>
    </div>
    <div class="nav-btn">
        <?php
        if ($offset != 0) {
            echo "<a href='./questions.php?offset=" . ($offset - 1) . "'><input type='button' value='←'></a>";
        }
        if ($offset != $max) {
            echo "<a href='./questions.php?offset=" . ($offset + 1) . "'><input type='button' value='→'></a>";
        }
        ?>
    </div>
</div>
<?php


include_once "./footer.php"
?>
</body>
</html>