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

    
<p>おしらせ一覧</p>
      <?php foreach ($data as $key => $value): ?>
            <p><?=h($value['title'])?>  :  <?=h($value['date'])?></p>
            <p><?=h($value['article'])?></p>
      <?php endforeach; ?>

</div>
<!-- work section --> 

<!-- Main[End] -->


</body>
</html>
