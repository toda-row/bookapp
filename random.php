<?php
$num = 8; // パスワードの文字数
$ar1 = range('a', 'z'); // アルファベット小文字を配列に
$ar2 = range('A', 'Z'); // アルファベット大文字を配列に
$ar3 = range(0, 9); // 数字を配列に
$ar_all = array_merge($ar1, $ar2, $ar3); // すべて結合
shuffle($ar_all); // ランダム順にシャッフル
echo substr(implode($ar_all), 0, $num); // 先頭の8文字
?>