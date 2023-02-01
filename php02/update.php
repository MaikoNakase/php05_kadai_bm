<?php
session_start();
require_once('funcs.php');
loginCheck();

//1. POSTデータ取得
$name   = $_POST['title'];
$email  = $_POST['url'];
$naiyou = $_POST['content'];
//$age    = $_POST['age'];
$id     = $_POST['id'];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE gs_bm_table SET title=:title,url=:url,content=:content WHERE id=:id;');
$stmt->bindValue(':title',   $title,   PDO::PARAM_STR);
$stmt->bindValue(':url',  $url,  PDO::PARAM_STR);
//$stmt->bindValue(':age',    $age,    PDO::PARAM_INT);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}
