<?php

include_once "./header.php";
include_once "./utils/conn.php";

if (isUser()) {
    $time = new DateTime();

    $qrUpdate = "UPDATE details SET isSubmit = TRUE WHERE isSubmit=FALSE AND username = '{$_SESSION[USER]}'";
    $link->query($qrUpdate);

    $qrInit = "INSERT INTO details(username, time, score, isSubmit, timestart) VALUES ('{$_SESSION[USER]}', 0, 0, FALSE , '{$time->getTimestamp()}')";
    $link->query($qrInit);
    $qrQuestions = "SELECT * FROM questions ORDER BY RAND() LIMIT " . NUM_QUESTION;
    $result = $link->query($qrQuestions);
    $i = 1;
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Test</title>
        <link rel="stylesheet" href="css/test.css">
        <script src="js/test.js"></script>
    </head>
    <body>
    <div class="content">
        <form action="check.php" method="post" name="test">
            <?php
            while ($row = $result->fetch_array()) {
                ?>
                <div>
                    <span><?php echo $i . '.) ' ?></span>
                    <span><?php echo $row[COL_CONTENT] ?></span>
                    <div>
                        <ul>
                            <li>
                                <input id="<?php echo $row[COL_ID] . A ?>" type="radio"
                                       name="<?php echo $row[COL_ID] ?>" value="a">
                                <label
                                    for="<?php echo $row[COL_ID] . A ?>"><?php echo A . "." . $row[COL_A] ?></label>
                            </li>
                            <li>
                                <input id="<?php echo $row[COL_ID] . B ?>" type="radio"
                                       name="<?php echo $row[COL_ID] ?>" value="b">
                                <label for="<?php echo $row[COL_ID] . B ?>"><?php echo B . "." . $row[COL_B] ?></label>
                            </li>
                            <li>
                                <input id="<?php echo $row[COL_ID] . C ?>" type="radio"
                                       name="<?php echo $row[COL_ID] ?>" value="c">
                                <label for="<?php echo $row[COL_ID] . C ?>"><?php echo C . "." . $row[COL_C] ?></label>
                            </li>
                            <li>
                                <input id="<?php echo $row[COL_ID] . D ?>" type="radio"
                                       name="<?php echo $row[COL_ID] ?>" value="d">
                                <label for="<?php echo $row[COL_ID] . D ?>"><?php echo D . "." . $row[COL_D] ?></label>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>
            <input type="submit" value="Nộp">
        </form>
        <div id="timer">15:00</div>
    </div>
    <?php
    include_once "./footer.php"
    ?>
    </body>
    </html>

    <?php
} else if (!isSigned()) {
    header("Location: ./login.php?next=" . $_SERVER['REQUEST_URI']);
} else {
    //TODO change other page
    echo "Bạn đang là admin";
}

$link->close();