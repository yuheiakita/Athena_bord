<?php

$dataFile = 'bbs.dat';

if ($_SERVER['REQUEST_METHOD'=='POST']){
  $message = $_POST['message'];
  $user = $_POST['user'];

  $newData = $message . "\t" . $user . "\n";

  $fp = fopen($dataFile, 'a');
  fwrite($fp,$newData);
  fclose($fp);

}


?>
<!DOCTYPE html>
<html lang="ja">
    <head>
      <div>
      <meta charest="utf-8">
        <title>Youtuberアングラコメ</title>

        <!--画像入れる予定-->
      </div>
    </head>
    <body>
      <div>
        <h1>Youtuberアングラコメ</h1>
        <p>~Youtubeで書き込めないことを書きまくろう笑~</p>
        <form action="" method="post">
        message:<input type="text" name="message">
        user:<input type="text" name="user">
        <input type="submit" value="投稿"> 
        </form>
      </div>
      <div>
          <h2>スレッド一覧</h2>
          <a href="contens.php">おすすめのスレッド</a>
      </div>
    </body>
  </html>
</html>
