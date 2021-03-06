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


$boardcomment  = $_POST["boardcomment"];
$nickname = $_SESSION["nickname"];
$workid = $_POST["workid"]; //作品ID
$uid = $_SESSION["anything"]; //ログインしたときのユーザーID




//1.POSTでParamを取得


//2.DB接続など
$pdo = db_con();


// ３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO 
          kashimaworkboard(
            comment_id,
            boardcomment,
            commentnickname,
            date,
            workid, 
            userid
          )VALUES(
            NULL,
            :boardcomment,
            :nickname,
            sysdate(),
            :workid, 
            :uid
          )");
          
$stmt->bindValue(':boardcomment', $boardcomment, PDO::PARAM_STR); 
$stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
$stmt->bindValue(':workid', $workid, PDO::PARAM_INT);
$stmt->bindValue(':uid', $uid, PDO::PARAM_INT);
$status = $stmt->execute();

//executeは実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError（SQLのエラー）:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: opendetail.php?id=$workid"); //Location:　のあとに必ずスペースが必要
  exit;

}



?>