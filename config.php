<?php
try{
    $db = new PDO('mysql:host=localhost;dbname=mini_bbs', 'root','');
}catch(PDOException $e){
    echo 'DB接続エラー'.$e->getMessage();
}

?>