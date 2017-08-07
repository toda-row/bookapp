<?php

session_start();

//1. POSTデータ取得
$studentname = $_SESSION["studentname"];
$lpw = $_POST["lpw"];
$email = $_POST["email"];
$nickname = $_POST["nickname"];
// $img = $_POST["img"];
var_dump($_POST);

//2. DB接続します
include("functions.php");

//2.DB接続など
$pdo = db_con();

//３．データ登録SQL作成
$update = $pdo->prepare("
  UPDATE kashimauser_table 
  SET 
    lpw=:lpw,
    email=:email,
    nickname=:nickname 
    WHERE studentname=:studentname
  ");
$update->bindValue(':studentname', $studentname, PDO::PARAM_STR);
$update->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$update->bindValue(':email', $email, PDO::PARAM_STR);
$update->bindValue(':nickname', $nickname, PDO::PARAM_STR);
$status = $update->execute(); //executeは実行

//データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $update->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
    header("Location: selectbook.php");
    exit;

}




?>