<?php

session_start();

//2. DB接続します
include("functions.php");
//1.POSTでParamを取得
$id = $_GET["id"]; 
// 作品ID

// var_dump($id);
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

//掲示板
$stmt3 = $pdo->prepare("SELECT * FROM kashimaworkboard WHERE workid=:id");
$stmt3->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status3 = $stmt3->execute(); //executeは実行
//データ表示
if($status3==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt3->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result2 = $stmt3->fetch(PDO::FETCH_ASSOC)){

   $data[] = $result2;
  }

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
  <div class="container jumbotron">
<form method="post" action="">
 <input type="hidden" name="id" value="<?=$id?>">　
   <fieldset>
    <legend>作品詳細</legend>
        <label>作品名：<input type="text" name="workname" value="<?=$row["workname"]?>"></label><br>
        <img src="<?=$row["img"]?>" width="300px"><br>
        <label>所属学校：<input type="text" name="ownercampus" value="<?=$row["ownercampus"]?>"></label><br>
        <label>作者ニックネーム：<input type="text" name="workowner" value="<?=$row["workowner"]?>"></label><br>
        <label><textArea name="comment" rows="4" cols="40"><?=$row["comment"]?></textArea></label><br>
        <label>投稿日時：<input type="text" name="date" value="<?=$row["date"]?>"></label><br>

    </fieldset>

    

</form>
  </div>
  
   <div class="container jumbotron">
    <form method="post" action="insertcomment.php">
    <input type="hidden" name="id" value="<?=$id?>">　
         <!--作品IDも一緒に送信-->
    <fieldset>
    <legend>コメントを投稿する</legend>
     <label>コメント<input type="text" name="boardcomment"></label><br>

     <input type="submit" value="送信">
    </fieldset>
    </form>
</div>
<!-- Main[End] -->

<!--掲示板-->
 <div class="container jumbotron">
        <p><?=$row["workname"]?>へのコメント</p>
              <?php foreach ((array) $data as $key => $value): ?>
                    <p><?=h($value["commentnickname"])?>：<?=h($value["boardcomment"])?></p>
                    <!--<p><?=h($value["date"])?></p>-->
              <?php endforeach; ?>
        
 </div>


</body>
</html>



