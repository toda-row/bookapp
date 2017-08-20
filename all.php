<?php

session_start();


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
<table class="table table-hover">
    <thead>
        <tr>
            <th>機能名</th>
            <th>新規</th>
            <th>編集</th>
            <th>削除</th>
            <th>補足</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>ユーザー登録</th>
            <td><a href=""> 新規 </a></td>
            <td><a href=""> 編集 </a></td>
            <td><a href=""> 削除 </a></td>
            <td>新規・削除は生徒ができない　編集は可能　申告制（セキュリティ重視）</td>
        </tr>
        <tr>
            <th>作品投稿</th>
            <td><a href=""> 新規 </a></td>
            <td><a href=""> 編集 </a></td>
            <td><a href=""> 削除 </a></td>
            <td>生徒が自由にできる　</td>
        </tr>
        <tr>
            <th>作品へのコメント</th>
            <td><a href=""> 新規 </a></td>
            <td><a href=""> 編集 </a></td>
            <td><a href=""> 削除 </a></td>
            <td>生徒が自由にできる　</td>
        </tr>
        <tr>
            <th>いいね機能</th>
            <td><a href=""> 新規 </a></td>
            <td><a href=""> 増やす/減らすのみ </a></td>
            <td><a href=""> できない</a></td>
            <td>生徒が自由にできる（制限もなし）　</td>
        </tr>
        <tr>
            <th>お知らせ</th>
            <td><a href=""> 新規 </a></td>
            <td><a href=""> 編集 </a></td>
            <td><a href=""> 削除 </a></td>
            <td>生徒が完全にできない　</td>
        </tr>
        <tr>
            <th>表彰（アワード）</th>
            <td><a href=""> 新規 </a></td>
            <td><a href=""> 編集 </a></td>
            <td><a href=""> 削除 </a></td>
            <td>生徒が完全にできない　</td>
        </tr>
        
    </tbody>
</table>
</div>
<!-- work section --> 

<!-- Main[End] -->


</body>
</html>
