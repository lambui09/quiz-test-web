<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<?php
include_once "./check/checkSigned.php";
if (isSigned()) {
    $next = './index.php';
    if (isset($_GET['next'])) {
        $next = $_GET['next'];
    }
    header("Location: " . $next);
    exit();
}
?>
<?php
include_once "./header.php"
?>
<body>
<form class="login" action="./check/checkLogin.php" method="post">
    <div class="container">
        <label><b>Username</b></label>
        <input type="text" name="user" placeholder="Username" required autocomplete="off" autofocus>

        <label><b>Password</b></label>
        <input type="password" name="pass" placeholder="Password" required autocomplete="off">
        <?php
        if (isset($_GET['next']) && $_GET['next'])
            echo '<input type="hidden" name="next" value="' . $_GET['next'] . '">';
        ?>
        <input type="submit" value="Login"/>
    </div>
</form>
</body>
</html>