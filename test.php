<?php

session_start();

//2. DB接続します
include("functions.php");
//1.POSTでParamを取得
$id = $_GET["id"]; 
// 作品ID

// var_dump($id);
//2.DB接続など
$pdo = db_con();

// /* config.php、functions.phpをそれぞれ読み込む。*/
// require_once dirname(__FILE__).'/config.php'; //設定関連の情報。
// require_once dirname(__FILE__).'/functions.php'; //関数関連の情報。
// /* functions.phpの中のデータベース接続のための関数を変数$dbhに代入。*/
// $dbh = db_connect( );
/* 空の配列を変数$tasksに代入。*/
$tasks = array( );
/* SELECT文を変数$sqlに代入。*/
$sql = "SELECT * FROM hitokoto WHERE disp = 1";
/* 
$tasksの中の配列に、データベースの情報を配列として$rowに格納したものをarray_push( )関数で格納。
array_push( )は配列の最後に要素を追加する。
例：
<?php
$ar = array("東京", "千葉", "神奈川");
array_push($ar, "埼玉");
print_r($ar);
?>
*/
/*
今回は$tasksが中身のない空の配列なので、
$dbh->query($sql)がデータベースの情報を一行ずつ取得した配列になるので、
それの値を$rowに代入し、$dbh->query($sql)の配列の値が無くなるまで$rowに代入し続ける。

例：
データベースの情報がデータベース名『rensyu0508』のテーブル『hitokoto』の中に
『データ型、カラム名』が
『int、id』、『varchar(40)、name』、『varchar(400)、comment』、『int、disp』
（dispに入れるの値は0か1にします。）の場合。

今回は$sqlの中にSELECT文で、dispの値が『1』のものを全て引っぱてきてる。
これは、カラム名がid, name, comment, dispをキー（添え字）とした連想配列でdisp = 1のものを
全て引っぱてきて、この要素の値を$rowに代入してるので、

$row = array('idの値', 'nameの値', 'commentの値', 'dispの値（今回は1）')
の連想配列になって、$dbh->query($sql)は$rowをキー（添え字）とした連想配列になるので
$dbh->query($sql) = array($row)
の二次元配列（配列の中に配列の入った）となる。

例えば、データベースにdisp = 1の情報が100個あった場合、
$dbh->query($sql)=array('array('idの値','nameの値','commentの値','1')','array('idの値','nameの値','commentの値','1')','array(・・・)',・・・・array(・・・));
キー（添え字）$rowが100個の配列になるので、

foreach文のところは
二次元配列$dbh->query($sql)からの値を配列$rowに代入して、それをarray_push( )関数で
配列$tasksの中に$rowを追加。

（※ array_push( )関数は1つ以上の要素を配列の最後に追加する。
例：
<?php
$stack = array("orange", "banana"); // 配列を$stackに代入。
array_push($stack, "apple", "raspberry"); 
print_r($stack);
?>
この例では『$stack』が配列、『"apple", "raspberry"』が要素。 ）

$tasks = array( );なので
array_push($tasks,$row)は
$tasks = array($row); ⇒ $tasks(array('idの値', 'nameの値', 'commentの値', '1'))
二次元配列$dbh->query($sql)の値が無くなるまで
array_push($tasks, $row);を繰り返す。
*/

foreach($pdo->query($sql) as $row){
  array_push($tasks, $row);
}
/*var_dump($tasks);*/

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>PDOクラス</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
// 現在日時を取得する関数
function get_current_timestamp( ){
  var weeks = new Array('日', '月', '火', '月', '水', '木', '金', '土');
  var d = new Date( );

/* 年月日・曜日・時分秒の取得 */
  var month = d.getMonth( ) +1;
  var day = d.getDate( );
  var week = weeks[d.getDay( )];
  var hour = d.getHours( );
  var minute = d.getMinutes( );
  var second = d.getSeconds( );

/* 1桁を2桁に変換する */
  if(month < 10){month = "0" + month;}
  if(day < 10){day = "0" + day;}
  if(hour < 10){hour = "0" + hour;}
  if(minute < 10){minute = "0" + minute;}
  if(second < 10){second = "0" + second;}

/* 整形して返却 */
  return d.getFullYear( ) + "/" + month + "/" + day + "("+ week +")" + hour + ":" + minute + ":" + second;
}

// 関数（親関数）の開始

$(function( ){
/* idがnameの要素にカーソルを持ってくる。*/
$('#name').focus( );
/* idがaddの要素がクリックされたら、関数（親関数）の中にある関数（子関数）を実行。*/
  $('#add').click(function( ){
    var name = $("#name").val( ); // idがnameのvalueの値を取得し変数に代入。
    var comment = $("#comment").val( ); // idがcommentのvalueの値を取得し変数に代入。
    var time = get_current_timestamp( ); // 現在日時を取得する関数を呼び出し変数に代入。
/* add.phpに『キー: 値』のPOST形式でデータを送り、（子関数）関数の中にある関数（孫関数）を実行。*/
  $.post('add.php',
  {
  name:name, 
  comment:comment,
  time:time
  },function(rs){
    var name = $("#name").val( ); // idがnameのvalueの値を取得し変数に代入。
    var comment = $("#comment").val( ); // idがcommentのvalueの値を取得し変数に代入。
    var time = get_current_timestamp( ); // 現在日時を取得する関数を呼び出し変数に代入。

/* ブラウザ上に表示する要素と変数name,comment,timeを値として配列に代入し変数にそれぞれ代入。*/
    var onText = new Array('<span id="name_'+rs+'">名前：', '</span><br><span id="comment_'+rs+'">コメント:', '</span><br>');
    var inputText = new Array(name, comment, time);

/* $('<li id="task・・・削除</button></li>')の要素を変数eに代入。*/
    var e = $('<li id="task_'+rs+'"data-id="'+rs+'"><span></span><button class="edit">編集</button><button class="delete">削除</button></li>');
/* 空の変数showtextに、for文で配列の値を順番に格納。showtextは配列になる？。*/
    showtext = " ";
    for(i = 0; i < inputText.length; i++){
      showtext += onText[ i ] + inputText[ i ];
    }

/* idが#tasksの要素に要素eを追加し、その中の'li:last span:eq(0)'の要素を見つけてshowtext要素を追加。。 */
    $('#tasks').prepend(e).find('li:first span:eq(0)').prepend(showtext); 
    $('#name').val(' ').focus( ); // idがnameのvalueを空にする。
    $('#comment').val(' '); // idがcommentのvalueを空にする。
    });
  });


// 削除ボタンを押した時のアクション

/* （子関数）の開始。 */
  $(function( ){
/* classがdeleteのものがクリックされたら、関数（子関数）の中にある関数（孫関数）を実行。*/
    $(document).on('click','.delete',function( ){
/*'本当に削除しますか？'のダイアログを表示し、『OK』をクリックした後の処理を記述。*/
      if(confirm('本当に削除しますか？')){
/* classがdeleteの、親要素の、キーが『id』に格納されている値を取得。この場合task_<?php echo h($task['id']); ?>。*/
        var id = $(this).parent( ).data('id');
/* delete.phpに『キー: 値』のPOSTデータ形式でデータを送り、関数（孫関数）の中にある関数（ひ孫関数）を実行。*/
        $.post('delete.php',
        {
        id:id
        },function(rs){
/* idがtask_<?php echo h($task['id']); ?>の要素をフェードアウトで消す。*/
        $('#task_'+id).fadeOut(800);
        });
      }
    });
 });


// 編集ボタンを押した時のアクション

/* classがeditのものがクリックされたら、関数（親関数）の中にある関数（子関数）を実行。*/
  $(document).on('click','.edit',function( ){
/* classがeditの親要素の、キーが『id』に格納されている値を取得。この場合のキーは『#id』値は『task_<?php echo h($task['id']); ?>』。*/
    var id = $(this).parent( ).data('id');
/* idがname_<?php echo h($task['id']); ?>のテキストを取得。*/
    var name = $('#name_'+id).text( );
/* idがcomment_<?php echo h($task['id']); ?>のテキストを取得。*/
    var comment = $('#comment_'+id).text( );
/* 現在日時を取得する関数を呼び出し変数に代入。*/
    var time = get_current_timestamp( );
/* ブラウザ上に表示する要素を値として配列に格納し変数に代入。*/
    var onTexts = new Array( '名前：<input type="text" id="name_'+id+' " class="name_'+id+'" size="30" value=" '+name+' "><br>', 'コメント：<br><textarea id="comment_'+id+' " class="comment_'+id+' " cols="40" rows="15">'+comment+'</textarea>');
/* 空の変数showtextに、for文で配列の値を順番に格納。showtextは配列になる？。*/
    showtexts = ' ';
    for(i = 0; i < onTexts.length; i++){
      showtexts += onTexts[ i ];
    }
/* idがtask_task_<?php echo h($task['id']); ?>の要素を空にして、showtext要素と'<br><input type="button" value="更新" class="update">'要素を追加し、その中からidがnameの要素を見つけカーソルを持ってくる。*/
    $('#task_'+id).empty( ).append(showtexts).append('<br><input type="button" value="更新" class="update">').find('#name').focus( );
  });


// 更新ボタンを押した時のアクション

/* classがupdateのものがクリックされたら、関数（親関数）の中にある関数（子関数）を実行。*/
  $(document).on('click', '.update', function( ){
/* classがupdateの親要素の、キーが『id』に格納されている値を取得。この場合のキーは『#id』値は『task_<?php echo h($task['id']); ?>』。*/
    var id = $(this).parent( ).data('id');
/* idがname_<?php echo h($task['id']); ?>のテキストを取得。*/
    var name = $('.name_'+id).val( );

/* idがcomment_<?php echo h($task['id']); ?>のテキストを取得。*/
    var comment = $('.comment_'+id).val( );
/* 現在日時を取得する関数を呼び出し変数に代入。*/
    var time = get_current_timestamp( ); 
/* update.phpに『キー: 値』のPOSTデータの形式でデータを送り、関数（子関数）の中にある関数（孫関数）を実行。*/
    $.post('update.php',
    {
    id:id,
    name:name,
    comment:comment,
    time:time
    },function(rs){
    var e = $('<span></span><button class="edit">編集</button><button class="delete">削除</button>');
/* */
    var name = $('.name_'+id).val( );
    var comment = $('.comment_'+id).val( );
    var time = get_current_timestamp( );

    var onTexts = new Array('<span id="name_'+rs+'">名前：', '</span><br><span       id="comment_'+rs+'">コメント:', '</span><br>'); 
    var inputTexts = new Array(name,comment,time);
    showtext = ' ';
    for(i = 0; i < inputTexts.length; i++){
      showtext += onTexts[ i ] + inputTexts[ i ];
    }

    $('#task_'+id).empty( ).append(showtext).append(e).find('span:eq(0)');
    });
  });

}); //親関数の締め。

</script>
</head>
<body>
<h1>PHPのPDOクラスとjavascriptのajax</h1>

名前：<input type="text" id="name" size="30"><br>
コメント：<br><textarea id="comment" cols="40" rows="15"></textarea>
<br><input type="button" id="add" value="投稿">

<ul id="tasks">

<!--$tasks = array($row) ⇒ $tasks = array('array('idの値','nameの値','commentの値','1')','array('idの値','nameの値','commentの値','1')',・・・)なので
$tasksの値を$taskに代入することを$tasksの値であるarray('idの値','nameの値','commentの値','1')がなくなるまで繰り返す。-->

<?php foreach($tasks as $task): ?>
<li id="task_<?php echo h($task['id']); ?>" data-id="<?php echo h($task['id']); ?>"><span>名前：<span id="name_<?php echo h($task['id']); ?>"><?php echo h($task['name']); ?></span><br>コメント：<span id="comment_<?php echo h($task['id']); ?>"><?php echo h($task['comment']); ?></span><br><?php echo h($task['time']); ?></span><button class="edit">編集</button><button class="delete">削除</button></li>
<?php endforeach; ?>

</ul>

</body>
</html>