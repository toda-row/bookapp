<?php
session_start();

//0.外部ファイル読み込み
include("functions.php");

//1.  DB接続します
$pdo = db_con();

//2. データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM kashimauser_table WHERE email=:email AND lpw=:lpw AND life_flg=0");
$stmt->bindValue(':email', $_POST["email"]);
$stmt->bindValue(':lpw', $_POST["lpw"]);
$res = $stmt->execute();

//3. SQL実行時にエラーがある場合
if($res==false){
        queryError($stmt);
}

//4. 抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //1レコードだけ取得する方法

//5. 該当レコードがあればSESSIONに値を代入
if( $val["id"] != "" ){
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["anything"]  = $val["id"];
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["nickname"]  = $val['nickname'];
  $_SESSION["studentname"]  = $val['studentname'];
  
  header("LOCATION: selectbook.php");
}else{
  //logout処理を経由して全画面へ
  header("LOCATION: login.php");
}

exit();

?>


