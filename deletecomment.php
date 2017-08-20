<?php

session_start();

//DB接続します
include("functions.php");
//1.POSTでParamを取得
$comment_id = $_GET["comment_id"];


var_dump($comment_id);


//2.DB接続など
$pdo = db_con();


//データ登録SQL削除
$delete = $pdo->prepare("DELETE FROM kashimaworkboard WHERE comment_id=:comment_id");
$delete->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
$status = $delete->execute(); //executeは実行




//データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $delete->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
    // header("Location: index.php");
    // header("Location: opendetail.php?id=$workid"); 
    exit;

}


?>