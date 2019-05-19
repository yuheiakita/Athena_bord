<?php
session_start();

//DBに接続
try{
  $dbh = new PDO('mysql:host=localhost;dbname=mini_bbs', 'root','');
  // DBに情報を挿入
  $statement = $dbh->prepare('INSERT INTO members SET name=?, email=?, password=?, created=NOW()');
  $statement->execute(array($_POST['name'], $_POST['email'], $_POST['password']));
   echo '情報が登録されました。';
}catch(PDOException $e){
  echo 'DB接続エラー'.$e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>Register</title>
 </head>
 <body>
     <a href="login.php">ログインする</a>
 </body>
</html>

