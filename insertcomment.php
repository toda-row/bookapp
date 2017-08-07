<?php
session_start();

//. DB接続します
include("functions.php");
//1. POSTデータ取得

// if(
//   !isset($_POST["boardcomment"]) || $_POST["boardcomment"]==""
// ){
//   exit('ParamError');
// }


$boardcomment  = $_POST["boardcomment"];
$nickname = $_SESSION["nickname"];
$id = $_POST["id"]; //作品ID
$uid = $_SESSION["anything"]; //ログインしたときのユーザーID

var_dump($boardcomment);
var_dump($nickname);
var_dump($id);


//1.POSTでParamを取得


//2.DB接続など
$pdo = db_con();


// ３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO 
          kashimaworkboard(
            id,
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
            :id, 
            :uid
          )");
          
$stmt->bindValue(':boardcomment', $boardcomment, PDO::PARAM_STR); 
$stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
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
  header("Location: opendetail.php?id=$id"); //Location:　のあとに必ずスペースが必要
  exit;

}



?>
