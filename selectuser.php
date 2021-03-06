<?php

session_start();


//1.  DB接続します
include("functions.php");
//1.POSTでParamを取得

//2.DB接続など
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM kashimauser_table");

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
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>生徒の一覧</title>
<link rel="stylesheet" href="css/range.css">
<link rel="stylesheet" href="css/main.css">
<link href="css/bootstrap.min.css" rel="stylesheet">

</head>
<body id="main">
  
<!-- header[Start] -->
<?php include ('header.php'); ?>
<!-- header[End] -->



<!-- Main[Start] -->



<div class="container jumbotron">
<table class="table table-hover">
    <thead>
        <tr>
            <th>生徒本名</th>
            <th>キャンパス名</th>
            <th>パスワード</th>
            <th>MAIL</th>
            <th>ニックネーム</th>
            <th>登録日</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $key => $value): ?>
        <tr>
            <th><?=h($value['studentname'])?></th>
            <td><?=h($value['campus'])?></td>
            <td><?=h($value['lpw'])?></td>
            <td><?=h($value['email'])?></td>
            <td><?=h($value['nickname'])?></td>
            <td><?=h($value['date'])?></td>
            <td><a href="detailuser.php?id=<?=$value['id']?>"> 編集 </a></td>
            <td><a href="deleteuser.php?id=<?=$value['id']?>"> 削除 </a></td>
        </tr>
      <?php endforeach; ?>

    </tbody>
</table>
</div>

<!-- Main[End] -->



</body>
</html>
