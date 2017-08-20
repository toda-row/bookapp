<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php">トップ</a>
        <a class="navbar-brand" href="selectwork.php">作品の一覧</a>
        <a class="navbar-brand" href="notice.php">お知らせ</a>
        
<!--        管理者のユーザー管理表示-->
<!--
        <?php
            if(
                $_SESSION['kanri_flg']==1
            ) {
                
        ?>
        <a class="navbar-brand" href="selectuser.php">生徒の一覧</a>
        <a class="navbar-brand" href="noticekanri.php">お知らせ管理</a>
        <a class="navbar-brand" href="registration.php">生徒の登録</a>

        <?php } else { ?>
            <!--空白-->
        <?php } ?>
<!--        管理者のユーザー管理表示-->

<!--        ユーザーのログイン・ログアウト表示-->
        <?php
            if(
                !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()
            ) {
        ?>
            <a class="navbar-brand" href="login.php">ログイン</a>
            <a class="navbar-brand" href="registration.php">ユーザー登録</a>            
        <?php } else { ?>
            <a class="navbar-brand" href="logout.php">ログアウト</a>
            <a class="navbar-brand" href="detailuser.php">プロフィール編集</a>
            <a class="navbar-brand" href="">
               <?php
                echo 'ようこそ ', $_SESSION['nnavbar-brandickname'], ' さん';
                ?>
            </a>
        <?php } ?>
<!--        ユーザーのログイン・ログアウト表示-->
<form class="navbar-brand"  action="searchresult.php" method="post">
<input type="text" name="search">
<input type="submit" value="検索">
</form>
        </div>
    </div>
  </nav>
</header>
