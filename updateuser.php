<?php

session_start();

//1. POSTデータ取得
$studentname = $_SESSION["studentname"];
$lpw = $_POST["lpw"];
$email = $_POST["email"];
$nickname = $_POST["nickname"];
// var_dump($_POST);



     

//2. DB接続します
include("functions.php");


//***FileUpload
if(isset($_FILES['studentpict']) && $_FILES['studentpict']['error']==0){
    $ownerupload_file = "./ownerupload/".$_FILES["studentpict"]["name"];
    if (move_uploaded_file($_FILES["studentpict"]['tmp_name'],$ownerupload_file)){
        chmod($ownerupload_file,0644);
    }else{
        echo "fileuploadOK...Failed";
    }
}else{
    echo "fileupload失敗";
}


//2.DB接続など
$pdo = db_con();

//３．データ登録SQL作成
$update = $pdo->prepare("
  UPDATE kashimauser_table 
  SET 
    lpw=:lpw,
    email=:email,
    nickname=:nickname,
    userimg=:userimg
    WHERE studentname=:studentname
  ");
$update->bindValue(':studentname', $studentname, PDO::PARAM_STR);
$update->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$update->bindValue(':email', $email, PDO::PARAM_STR);
$update->bindValue(':nickname', $nickname, PDO::PARAM_STR);
$update->bindValue(':userimg', $ownerupload_file, PDO::PARAM_STR);
$status = $update->execute(); //executeは実行

//データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $update->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
    header("Location: selectwork.php");
    exit;

}




?>