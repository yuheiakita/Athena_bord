<?php
session_start();
require('config.php');
//タイムセッションで自動ログアウト
if(isset($_SESSION['id'])&& $_SESSION['time'] + 3600>time()){
    $_SESSION['time'] = time();

    $members = $db->prepare('SELECT* FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member =  $members->fetch();
}else{
    header('Location:login.php'); //ログインしていない場合は自動的にログインページへ飛ばされる
    exit();
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
   <title>AthenaBorad</title>
 </head>
 <body>
     <a href="register.php">新規登録</a>
     <a href="login.php">ログイン</a>
     <a href="logout.php">ログアウト</a>
   
     <div class="container">
    <h1>AthenaBorad</h1>
    <form action=""   method="post">
        <p><?php print(htmlspecialchars($member['name'],ENT_QUOTES)); ?>さん投稿してください</p>
        </div>
        <div class="form-group">
            <label for="content">本文</label>
            <textarea cols="50" rows="5" name="message"></textarea>
        </div>
        <button type="submit" class="btn btn-info">投稿</button>
    </form>
</div>

<?php foreach($posts as $post): ?>
<div class="msg">
    <p><?php print(htmlspecialchars($post['message'], ENT_QUOTES)); ?>
        <span class="name">(<?php print(htmlspecialchars($post['name'], ENT_QUOTES)); ?>)</span></p>
    <p calss="day"><a href="view.php?id"><?php print(htmlspecialchars($post['created'], ENT_QUOTES)); ?></a>
    <?php if ($_SESSION['id']==$post['member_id']): ?>
    <a href="post_delete.php?id=<?php print(htmlspecialchars($post['id'])); ?>" style="=color:#F33;">削除</a>
<?php endif;?>
</div>
<?php endforeach; ?>
 </body>
</html>