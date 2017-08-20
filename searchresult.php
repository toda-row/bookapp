<?php

session_start();

header("Content-type: text/html; charset=utf-8");
 
if(empty($_POST)) {
	header("Location: pdo_search_form.html");
	exit();
}else{
	//名前入力判定
	if (!isset($_POST['search'])  || $_POST['search'] === "" ){
		$errors['search'] = "名前が入力されていません。";
	}
}
 
//1.  DB接続します
include("functions.php");
//1.POSTでParamを取得

//2.DB接続など
$pdo = db_con();


		$statement = $pdo->prepare("SELECT * FROM kashimawork_table WHERE concat(workname, workowner, studentname) LIKE (:search) ");
	
		if($statement){
			$search = $_POST['search'];
			$like_search = "%".$search."%";
			//プレースホルダへ実際の値を設定する
			$statement->bindValue(':search', $like_search, PDO::PARAM_STR);
			
			if($statement->execute()){
				//レコード件数取得
				$row_count = $statement->rowCount();
				
				while($row = $statement->fetch()){
					$rows[] = $row;
				}
				
			}else{
				$errors['error'] = "検索失敗しました。";
			}
			
			//データベース接続切断
			$dbh = null;	
		}
	



?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
　<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>鹿島学園イラスト部</title>
  <link rel="stylesheet" href="css/main.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">

</head>
<body>


<!-- Head[Start] -->

<!-- Head[End] -->

<!-- header[Start] -->
<?php include ('header.php'); ?>
<!-- header[End] -->


<!-- Main[Start] -->
<!-- work section -->
<div class="container jumbotron">
<?php if (count($errors) === 0): ?>
 
<p><?="『　".htmlspecialchars($search, ENT_QUOTES, 'UTF-8')."　』で検索しました。"?></p>
<p><?=$row_count?>件です。</p>
 
<table class="table table-hover" >
<tr><td>作品画像</td><td>作品名</td><td>作者</td></tr>
 
<?php 
foreach((array)$rows as $row){
?> 
<tr> 
    <a href="opendetail.php?id=<?=$row['id'];?>" >
	<td><div class="searchimg"><img src="<?=$row["img"]?>" ></div></td> 
	<td><?=htmlspecialchars($row['workname'],ENT_QUOTES,'UTF-8')?></td> 
	<td><?=htmlspecialchars($row['workowner'],ENT_QUOTES,'UTF-8')?></td> 
	</a>
</tr> 
<?php 
} 
?>
 
<?php elseif(count($errors) > 0): ?>
<?php
foreach($errors as $value){
	echo "<p>".$value."</p>";
}
?>
<?php endif; ?>
 
    </div>
<!-- work section --> 

<!-- Main[End] -->


</body>
</html>
