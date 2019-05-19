<?php 
//クッキーを切ってログアウトする
session_start();
$_SESSION=array();
if (ini_set('session.use_cookies')){
    $params=session_get_cookie_params();
    setcookie(session_name() . '', time()-42000,
    $params['path'],$params['domain'],$params['secure'],$params['httponly']);
}
session_destroy();

setcookie('email','',time()-3600);

header('Location:login.php');
exit();
?>



<!DOCTYPE html>

<html lang="ja">

<head>
<meta charset="utf-8">
<title>Log Out</title>
<link rel="stylesheet" type="text/css" href="CSS/styles_logout.css">

</head>

<body>
<div class="form-wrapper">
    <h1>Log Out</h1>
    <p><font color="blue"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES,  'SJIS'); ?></font></p>
    <ul>

        <li><a class="form-footer" href="login.php">ログイン画面に戻る</a></li>
        <li><a class="form-footer" href="index.php">掲示板を閲覧</a></li>
    </ul>
</div>
</body>

</html>