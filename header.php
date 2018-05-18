<link rel="stylesheet" href="./css/header.css">
<div class="header">
    <a class="home" href="./">Trang chủ</a>
    <label class="nav-button" for="nav-trigger">:)</label>
    <?php
    include_once "./check/checkSigned.php";
    if (isSigned()) {
        $href = "./logout.php";
        $text = "Logout";
    } else {
        $href = "./login.php";
        $text = "Login";
    }
    echo "<a class='btn' href='$href'><input type='button' value='$text'></a>";
    if (isAdmin()) {
        echo "<a class='btn' href='./questions.php'><input type='button' value='Câu hỏi'></a>";
    } else if (isset($_SESSION[USER])) {
        echo "<a class='btn' href='./test.php'><input type='button' value='Vào thi'></a>";
        echo "<a class='btn' href='./detail.php?username={$_SESSION[USER]}'><input type='button' value='Kết quả'></a>";
    }
    ?>
    <form action="./view.php" method="post">
        <div class="search-frame">
            <input name="key" class="search" type="text" placeholder="Tìm kiếm">
            <input class="addon" type="submit" value="O">
        </div>
    </form>
</div>