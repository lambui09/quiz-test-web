<html>
<head>
    <title>View</title>
    <link rel="stylesheet" href="./css/view.css">
</head>
<body>
<?php
include "header.php";
?>
<div class="container">
    <?php
    if (!isset($_GET['username'])) {
        $next = "/";
        if (isset($_SERVER["HTTP_REFERER"])) {
            $next = $_SERVER["HTTP_REFERER"];
        }
        header("Location: " . $next);
        exit(0);
    }

    include_once "./utils/conn.php";
    $qrView = "
        SELECT name
        FROM detailuser
        WHERE username = '{$_GET[COL_USER]}'";

    $result = $link->query($qrView);
    if ($result->num_rows <= 0) {
        echo "Khong co ai ca";
        $link->close();
        exit(0);
    }
    $row = $result->fetch_array();
    if (isAdmin()) {
        $isAdmin = true;
    }
    if (isset($_SERVER['HTTP_REFERER'])){
        echo "<a href='{$_SERVER['HTTP_REFERER']}'><input type='button' value='Back'></a>";
    }
    ?>



    <div class="table-panel">
        <table>
            <caption><?php echo $row[COL_NAME] ?></caption>
            <thead>
            <tr>
                <th>STT</th>
                <th>Điểm</th>
                <th>Thời gian làm bài</th>
                <th>Thời gian thành</th>
                <?php
                if (isset($isAdmin) && $isAdmin){
                    echo "<td>Xóa</td>";
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            $index = 0;

            $qrView = "
                SELECT id, time, score, timestart
                FROM details
                WHERE username = '{$_GET[COL_USER]}'
                ORDER BY timestart DESC";

            $result = $link->query($qrView);
            while ($row = $result->fetch_array()) {
                $index++;
                ?>
                <tr>
                    <td><?php echo $index ?></td>
                    <td><?php echo $row[COL_SCORE] ?></td>
                    <td><?php echo $row[COL_TIME] ?></td>
                    <td><?php echo date("H:i:s d/m/Y", $row[COL_TIME_START]) ?></td>
                    <?php
                    if (isset($isAdmin) && $isAdmin) {
                        echo "<td><a href='./delete.php?id={$row[COL_ID]}'>❌</a></td>";
                    }
                    ?>
                </tr>
                <?php
            }

            $link->close();
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include_once "./footer.php"
?>
</body>
</html>