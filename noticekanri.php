<?php

session_start();

//1.  DB接続します
include("functions.php");
//1.POSTでParamを取得

//2.DB接続など
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM publicboard");

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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>鹿島学園イラスト部</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

</head>
<body>
<!-- header[Start] -->
<?php include ('header.php'); ?>
<!-- header[End] -->


<!-- Main[Start] -->
<!-- work section -->


<div class="container jumbotron">
    
<!-- Main[Start] -->
<form method="post" action="insertnotice.php" enctype="multipart/form-data">
  <div class="container jumbotron">
   <fieldset>
    <legend>お知らせを投稿する</legend>
     <label>タイトル：<input type="text" name="title"></label><br>
     <label><textArea name="article" rows="4" cols="40">記事内容</textArea></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

    
<p>おしらせ一覧</p>
<table class="table table-hover">
    <thead>
        <tr>
            <th>タイトル</th>
            <th>日付</th>
            <th>記事</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $key => $value): ?>
        <tr>
            <th><?=h($value['title'])?></th>
            <td><?=h($value['date'])?></td>
            <td><?=h($value['article'])?></td>
            <td><a href="editnotice.php?id=<?=$value['id']; ?>"> 編集 </a></td>
            <td><a href="deletenotice.php?id='.$result["id"].'"> 削除 </a></td>
        </tr>
      <?php endforeach; ?>

    </tbody>
</table>
</div>
<!-- work section --> 

<!-- Main[End] -->


</body>
</html>
