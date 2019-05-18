<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>Register</title>
 </head>
 <body>
   <h1>新規登録</h1>
   <form action="register_done.php" method="post">
    <label for="name">ニックネーム</label>
    <input type="name" name="name"><br>
     <label for="email">email</label>
     <input type="email" name="email"><br>
     <label for="password">password</label>
     <input type="password" name="password"><br>
     <button type="submit">Sign Up!</button>
     <p>※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
   </form>
 </body>
</html>