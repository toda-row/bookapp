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
  <title>鹿島学園イラスト部</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php">トップ</a>
        <a class="navbar-brand" href="selectbook.php">作品の一覧</a>
        <a class="navbar-brand" href="selectbook.php">お知らせ</a>
        <a class="navbar-brand" href="pdo_search_form.html">検索</a>
        

        
<!--        管理者のユーザー管理表示-->
<!--
        <?php
            if(
                $_SESSION['kanri_flg']==1
            ) {
        ?>

        <?php } else { ?>
            空白
        <?php } ?>
-->
<!--        管理者のユーザー管理表示-->

<!--        ユーザーのログイン・ログアウト表示-->
        <?php
            if(
                !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()
            ) {
        ?>
            <a class="navbar-brand" href="login.php">ログイン</a>
            <a class="navbar-brand" href="registration.php">ユーザー登録</a>            
        <?php } else { ?>
            <a class="navbar-brand" href="logout.php">ログアウト</a>
            <a class="navbar-brand" href="">
               <?php
                echo 'ようこそ ', $_SESSION['nickname'], ' さん';
                ?>
            </a>
        <?php } ?>
<!--        ユーザーのログイン・ログアウト表示-->
<form class="navbar-brand"  action="searchresult.php" method="post">
<input type="text" name="search">
<input type="submit" value="検索">
</form>
        </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="">
 <input type="hidden" name="id" value="<?=$id?>">
  <div class="jumbotron">
   <fieldset>
    <legend>作品詳細</legend>
        <label>作品名：<input type="text" name="workname" value="<?=$row["workname"]?>"></label><br>
        <img src="<?=$row["img"]?>" width="300px"><br>
        <label>所属学校：<input type="text" name="bookurl" value="<?=$row["bookurl"]?>"></label><br>
        <label>作者ニックネーム：<input type="text" name="bookurl" value="<?=$row["bookurl"]?>"></label><br>
        <label><textArea name="comment" rows="4" cols="40"><?=$row["comment"]?></textArea></label><br>
        <label>投稿日時：<input type="text" name="date" value="<?=$row["date"]?>"></label><br>

    </fieldset>
    <form method="post" action="insertcomment.php" enctype="multipart/form-data">
    <fieldset>
    <legend>コメントを投稿する</legend>
     <label>コメント<input type="text" name="boardcomment"></label><br>
     <input type="submit" value="送信">
    </fieldset>
    </form>
    
  </div>
</form>
<!-- Main[End] -->


</body>
</html>



