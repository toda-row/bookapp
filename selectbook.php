<?php

session_start();
$hensu = $_SESSION["anything"];
// $studentname = $_SESSION["studentname"];

//1.  DB接続します
include("functions.php");

//2.DB接続など
$pdo = db_con();

//　登録した-ユーザーの作品データ
$sql2 = "SELECT *
          FROM kashimauser_table
         WHERE id = :userid";
$stmt2 = $pdo->prepare($sql2);
$stmt2->bindValue(':userid', $hensu);
//baintvalue で検索
$status2 = $stmt2->execute();

//３．データ表示
if($status2==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt2->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  $result2 = $stmt2->fetch();
    // echo '<pre>';
    // var_dump($result2['kanri_flg']);
    // echo '</pre>';

}




//管理者であれば全てのデータを表示
$sql = '';
if ($result2['kanri_flg'] == 1) {
    $sql = "SELECT *
          FROM kashimawork_table";
} else {
    $sql = "SELECT *
          FROM kashimawork_table
         WHERE userid = :userid";
}



$stmt = $pdo->prepare($sql);
$stmt->bindValue(':userid', $hensu);
$status = $stmt->execute();

//３．データ表示
// $view="";
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
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>作品一覧表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">


<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">トップ</a>

        <a class="navbar-brand" href="selectbook.php">作品の一覧</a>
<?php
            if(
                !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()
            ) {
        ?>
            <a class="navbar-brand" href="login.php">ログイン</a>
            <a class="navbar-brand" href="registration.php">ユーザー登録</a>            
        <?php } else { ?>
            <a class="navbar-brand" href="logout.php">ログアウト</a>
            <a class="navbar-brand" href="detailuser.php">ユーザー編集</a>
            <a class="navbar-brand" href="">
               <?php
                echo 'ようこそ ', $_SESSION['nickname'], ' さん';
                ?>
            </a>

        <?php } ?>
        
        <?php
            if(
                $_SESSION['kanri_flg']==1
            ) {
        ?>
<a class="navbar-brand" href="selectuser.php">生徒の一覧</a>
        <?php } else { ?>
            <!--空白-->
        <?php } ?>
        
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insertbook.php" enctype="multipart/form-data">
  <div class="container jumbotron">
   <fieldset>
    <legend>作品を投稿する</legend>
     <label>作品名：<input type="text" name="workname"></label><br>
     <label><textArea name="comment" rows="4" cols="40">作品コメント</textArea></label><br>
     <input type="file" name="filename"><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<!-- Main[Start] -->

    <div class="container jumbotron">
        <p><?php  echo  $_SESSION['nickname']; ?>さんの登録作品一覧</p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>作品画像</th>
                    <th>作品名</th>
                    <th>コメント</th>
                    <th>公開日時</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ((array) $data as $key => $value): ?>
                <tr>
                    <th><img src="<?=$value['img']; ?>" width="100"></th>
                    <td><?=h($value["workname"])?></td>
                    <td><?=h($value["comment"])?></td>
                    <td><?=h($value["date"])?></td>
                    <td><a href="bookdetail.php?id=<?=$value['id']; ?>"> 編集 </a></td>
                    <td><a href="deletebook.php?id=<?=$value['id']; ?>"> 削除 </a></td>
                </tr>
              <?php endforeach; ?>
        
            </tbody>
            </table>
    </div>

<!-- Main[End] -->

</body>
</html>
