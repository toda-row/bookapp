<?php
session_start();




//. DB接続します
include("functions.php");
//1. POSTデータ取得

// ログインしてなければlogin.phpに
// 機能しない？
  // if(
  //     !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()
  // ) {
  // } else {
  //     header("Location: login.php"); //Location:　のあとに必ずスペースが必要
  // exit;
  // }

// if(
//   !isset($_POST["boardcomment"]) || $_POST["boardcomment"]==""
// ){
//   exit('ParamError');
// }


$title  = $_POST["title"];
$article  = $_POST["article"];


//1.POSTでParamを取得


//2.DB接続など
$pdo = db_con();


// ３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO 
          publicboard(
            id,
            title,
            article,
            date
          )VALUES(
            NULL,
            :title,
            :article,
            sysdate()
          )");
          
$stmt->bindValue(':title', $title, PDO::PARAM_STR); 
$stmt->bindValue(':article', $article, PDO::PARAM_STR);

$status = $stmt->execute();

//executeは実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError（SQLのエラー）:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: noticekanri.php"); //Location:　のあとに必ずスペースが必要
  exit;

}



?>