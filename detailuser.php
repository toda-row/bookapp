<?php
session_start();


//2. DB接続します
include("functions.php");

$studentname = $_SESSION["studentname"];

// var_dump($id);

//2.DB接続など
$pdo = db_con();


//３．データ登録SQL変更
$stmt = $pdo->prepare("SELECT * FROM kashimauser_table WHERE studentname=:studentname");
$stmt->bindValue(':studentname', $studentname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
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
  <title>ユーザーデータ編集</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="selectuser.php">ユーザーの一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="updateuser.php" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?=$studentname?>">
  <div class="container jumbotron">
   <fieldset>
    <legend>プロフィールを編集する</legend>
    <p>基本情報（変更不可）</p>
     <label>本名：<input type="text" name="studentname" value="<?=$row["studentname"]?>"></label><br>
     <label>キャンパス名：<input type="text" name="campus" value="<?=$row["campus"]?>"></label><br>
    <p>基本情報（変更可能）</p>
     <label>パスワード：<input type="text" name="lpw" value="<?=$row["lpw"]?>"></label><br>
     <label>MAIL：<input type="text" name="email" value="<?=$row["email"]?>"></label><br>
     <label>ニックネーム（表示名）：<input type="text" name="nickname" value="<?=$row["nickname"]?>"></label><br>
     <label>画像：<img src="<?=$row["userimg"]?>" width="100">
     <input type="file" name="studentpict" value="<?=$row["userimg"]?>"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>



