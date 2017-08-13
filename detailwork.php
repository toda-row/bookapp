<?php
session_start();


//2. DB接続します
include("functions.php");
//1.POSTでParamを取得
$id = $_GET["id"];


//2.DB接続など
$pdo = db_con();


//３．データ登録SQL変更
$stmt = $pdo->prepare("SELECT * FROM kashimawork_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //executeは実行

//データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
    $row = $stmt->fetch();

}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>作品詳細編集</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- header[Start] -->
<?php include ('header.php'); ?>
<!-- header[End] -->

<!-- Main[Start] -->
<form method="post" action="updatework.php" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?=$id?>">
  <div class="container jumbotron">
   <fieldset>
    <legend>作品を編集する</legend>
     <label>作品名：<input type="text" name="workname" value="<?=$row["workname"]?>"></label><br>
     <label><textArea name="comment" rows="4" cols="40"><?=$row["comment"]?></textArea></label><br>
     <label>投稿日時：<input type="text" name="date" value="<?=$row["date"]?>"></label><br>
     <img src="<?=$row["img"]?>" width="100">
     
     <input type="file" name="filename" value="<?=$row["img"]?>"><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>



