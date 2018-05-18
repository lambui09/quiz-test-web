<html>

<head>
    <title>View</title>
    <link rel="stylesheet" href="css/view.css">
</head>
<body>
<?php
include_once "header.php";
?>
<div class="container">
    <?php
    include_once "./utils/conn.php";
    $cond = "";
    if (isset($_POST['key'])) {
        $cond = "WHERE detailuser.name LIKE '%{$_POST['key']}%'
                     OR detailuser.class = '{$_POST['key']}'
                     OR detailuser.username = '{$_POST['key']}'
                     OR YEAR(detailuser.birthday) = '{$_POST['key']}'";
    }
    $qrView = "
        SELECT detailuser.*, sum(details.time), sum(details.score), count(details.id)
        FROM detailuser
        LEFT JOIN details
        ON detailuser.username = details.username
        $cond
        GROUP BY detailuser.username
        ORDER BY sum(details.score) DESC 
        ";
//        echo $qrView;
    $result = $link->query($qrView);
    if (isAdmin()) {
        $isAdmin = true;
        echo "<a class='add' href='./addSv.php'><input type='button' value='+'></a>";
    }
    ?>
    <div class="table-panel">
        <table>
            <caption>Kết quả thi</caption>
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên SV</th>
                <th>Lớp</th>
                <th>Ngày sinh</th>
                <th>Tổng điểm</th>
                <th>Số lần thi</th>
                <th>Tổng thời gian</th>
                <?php
                if (isset($isAdmin) && $isAdmin){
                    echo "<td>Chỉnh sửa</td>";
                    echo "<td>Xóa</td>";
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            $index = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_array()) {
                    $index++
                    ?>
                    <tr>
                        <td><?php echo $index ?></td>
                        <td class="left">
                            <a href="./detail.php?username=<?php echo $row[COL_USER] ?>"><?php echo $row[COL_NAME] ?></a>
                        </td>
                        <td><?php echo $row[COL_CLASS] ?></td>
                        <td><?php echo $row[COL_BIRTHDAY] ?></td>
                        <td><?php  if ($row[COL_TOTAL_COUNT] == 0){ echo 0;} else echo $row[COL_TOTAL_SCORE] ?></td>
                        <td><?php echo $row[COL_TOTAL_COUNT] ?></td>
                        <td><?php  if ($row[COL_TOTAL_COUNT] == 0){ echo 0;} else echo $row[COL_TOTAL_TIME] ?></td>
                        <?php
                        if (isset($isAdmin) && $isAdmin) {
                            echo "<td><a href='./editSv.php?username={$row[COL_USER]}'>✍</a></td>";
                            echo "<td><a href='./deleteSv.php?username={$row[COL_USER]}'>❌</a></td>";
                        }
                        ?>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td>Khong co data</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<input id="nav-trigger" type="checkbox">
<div class="right-bar">
    <div class="table-panel">
        <table>
            <caption>Danh sách điểm cao</caption>
            <thead>
            <tr>
                <th>Tên SV</th>
                <th>Tổng điểm</th>
                <th>Số lần thi</th>
                <th>Tổng thời gian</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $qrView = "
        SELECT name, sum(details.time), sum(details.score), count(time)
        FROM detailuser, details
        WHERE detailuser.username = details.username
        GROUP BY details.username
        ORDER BY sum(score) DESC 
        LIMIT " . COUNT_HIGH;
            //    echo $qrView;
            $result = $link->query($qrView);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_array()) {
                    $index++
                    ?>
                    <tr>
                        <td><?php echo $row[COL_NAME] ?></td>
                        <td><?php echo $row[COL_TOTAL_SCORE] ?></td>
                        <td><?php echo $row[COL_COUNT_TIME] ?></td>
                        <td><?php echo $row[COL_TOTAL_TIME] ?></td>
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
</div>
<?php
include_once "./footer.php"
?>
</body>
</html>