<?php
session_start();

//1. POSTデータ取得

$studentname   = $_POST["studentname"];
$campus = $_POST["campus"];
$email = $_POST["email"];
$lpw = $_POST["lpw"];


//2. DB接続します
include("functions.php");
//1.POSTでParamを取得
$id = $_GET["id"];

//2.DB接続など
$pdo = db_con();


// ３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO 
          kashimauser_table(
            id,
            studentname,
            campus,
            email,
            lpw, 
            kanri_flg, 
            life_flg, 
            date,
            nickname,
            studentimg
          )VALUES(
            NULL,
            :studentname,
            :campus,
            :email,
            :lpw, 
            0, 
            0, 
            sysdate(),
            NULL,
            NULL
          )");
          
$stmt->bindValue(':studentname', $studentname, PDO::PARAM_STR); 
$stmt->bindValue(':campus', $campus, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//executeは実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError（SQLのエラー）:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php"); //Location:　のあとに必ずスペースが必要
  exit;

}




?>
