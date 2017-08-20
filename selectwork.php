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
<!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>作品一覧表示</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<!-- header[Start] -->
<?php include ('header.php'); ?>
<!-- header[End] -->


<!-- Main[Start] -->
<form method="post" action="insertwork.php" enctype="multipart/form-data">
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
                    <td><a href="detailwork.php?id=<?=$value['id']; ?>"> 編集 </a></td>
                    <td><a href="deletework.php?id=<?=$value['id']; ?>"> 削除 </a></td>
                </tr>
              <?php endforeach; ?>
        
            </tbody>
            </table>
    </div>

<!-- Main[End] -->

</body>
</html>
