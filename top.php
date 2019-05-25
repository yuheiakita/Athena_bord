<?php
session_start();
require('config.php');
//タイムセッションで自動ログアウト
if(isset($_SESSION['id'])&& $_SESSION['time'] + 3600>time()){
    $_SESSION['time'] = time();

    $members = $db->prepare('SELECT* FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member =  $members->fetch();
}


//投稿内容をDBへ保存
if (!empty($_POST)){
    if ($_POST['message'] !==''){
        $message =  $db->prepare('INSERT INTO posts SET member_id=?, message=?, created=NOW()');
        $message->execute(array($member['id'],$_POST['message']));

        //投稿内容が重複してDBに保存されないように防止役
        header('Location:index.php');
        exit();
    }
}
//投稿内容を画面に表示
$posts = $db->query('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC');
?>


<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="style.css">
   <!-- <link rel="stylesheet" href="reset.css"> -->
   <title>AthenaBorad</title>
   <p class="borad_naem">AthenaBorad</p>
 </head>
 <body>
     <div class="button_conteiner">
     <a href="register.php" class="button">新規登録</a>
     <a href="login.php" class="button">ログイン</a>
     <a href="logout.php" class="button">ログアウト</a>
     </div>
     </div>

     <p class="login_name">ログインしてください</p>
   
    <form action=""   method="post" >
        <div class="form-group">
            <textarea cols="50" rows="5" name="message" class="textarea" placeholder="今日の気分を投稿してください"></textarea>
        </div class="post">
        <button type="submit" class="btn-info">投稿</button>
    </form>
</div>

<?php foreach($posts as $post): ?>
<div class="msg">
    <p class="msg_01"><?php print(htmlspecialchars($post['message'], ENT_QUOTES)); ?>
        <span class="name">(<?php print(htmlspecialchars($post['name'], ENT_QUOTES)); ?>)</span></p>
    <p calss="day"><a href="view.php?id" class="time"><?php print(htmlspecialchars($post['created'], ENT_QUOTES)); ?></a>
</div>
<?php endforeach; ?>
 </body>
</html>