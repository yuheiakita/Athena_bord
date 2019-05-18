<?php
session_start();
require('config.php');

if($_COOKIE['email']!==''){
  $email=$_COOKIE['email'];
}

//DBへ問い合わせ
if(!empty($_POST)){
  if($_POST['email']!==''&& $_POST['password']!==''){
    $login = $db->prepare('SELECT* FROM members WHERE email=? AND password=?');
    $login->execute(array($_POST['email'],$_POST['password']));
    $member = $login->fetch();

    //ログイン成功した時にindex.phpにとぶ、違う場合はページ遷移しない
    if($member){
      $_SESSION['id'] = $member['id'];
      $_SESSION['time'] = time();

      if($_POST['save'] === 'on'){
        setcookie('email',$_POST['email'], time()+60*60*24*14);
      }

      header('Location:index.php');
      exit();
    }else{
      $error['login'] = 'failed';
    }
  }else{
    $error['login'] = 'blank';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>Login</title>
 </head>
 <body>
   <h1>ログイン</h1>
   <form action="" method="post">
    <div>
     <label for="email">email</label>
     <input type="email" name="email"><br>
    </div>
     <label for="password">password</label>
     <input type="password" name="password"><br>
     <div><input id="save" type="checkbox" name="save" value="on">
     <label for="save">次回から自動的にログインする</label>
    </div>
     <button type="submit">Login</button>
   </form>
 </body>
</html>

