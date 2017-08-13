<?php
// カウントアップ処理
$file	= $_POST['file']; //ファイル名
$count	= $_POST['count'];  //投票数
$check	= $_SERVER['HTTP_X_REQUESTED_WITH'];

if ($file && $count && $check && strtolower($check) == 'xmlhttprequest') {
	$filename = 'data/'.$file.'.dat';
	$fp = @fopen($filename, 'w');
	flock($fp, LOCK_EX); //排他的ロック(書く準備) 他のロックをすべてブロック
	fputs($fp, $count); //カウント数を書き込み
	flock($fp, LOCK_UN);  //ロック開放
	fclose($fp);
	echo 'success';  //ここの値を返す
}
