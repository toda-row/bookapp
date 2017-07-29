<?php

session_start();

//1.  DB接続します
include("functions.php");
//1.POSTでParamを取得

//2.DB接続など
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");

//baintvalue で検索

$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){

   $data[] = $result;
  }

}


?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>09POSTデータ登録</title>
  <link rel="stylesheet" href="">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
  <style>
      .aaa {
          color: red;
      }
</style>
</head>
<body>


<!-- Head[Start] -->

<!-- Head[End] -->

<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php">トップ</a>
        <a class="navbar-brand" href="selectbook.php">書籍の一覧</a>

       <a class="navbar-brand" href="selectuser.php">ユーザーの一覧</a>
        
<!--        管理者のユーザー管理表示-->
<!--
        <?php
            if(
                $_SESSION['kanri_flg']==1
            ) {
        ?>
        <a class="navbar-brand" href="selectuser.php">ユーザーの一覧</a>
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
        <?php } else { ?>
            <a class="navbar-brand" href="logout.php">ログアウト</a>
            <a class="navbar-brand" href="logout.php">
               <?php
                echo 'ようこそ ', $_SESSION['name'], ' さん';
                ?>
            </a>
        <?php } ?>
<!--        ユーザーのログイン・ログアウト表示-->
        </div>
    </div>
  </nav>
</header>


<!-- Main[Start] -->
<table>

    <div class="container jumbotron">
    <p>登録書籍一覧</p>
    <?php foreach ($data as $key => $value): ?>
        <p>
          <a href="opendetail.php?id=<?=$value['id'];?>">
           <img src="<?=$value["img"]?>" width="100">
            <?=h($value['bookname']) . '  [' . h($value['manthday']) . ']'?>
          </a>
          &nbsp;
          <a href="opendetail.php?id=<?=$value['id']; ?>">
            [いいね]
          </a>
        </p>
      <?php endforeach; ?>
    
    
    </div>
</table>
<!-- Main[End] -->


</body>
</html>
