    <div class="jumbotron sidebar col-lg-2 col-sm-2 hidden-xs" >
      <p>鹿島学園<br>イラスト部</p>
      <div id="menu-box">
          <div id="toggle" class="mainnavbar"><a href="#">menu</a></div>
          <ul id="menu list" >

      <li ><a class="mainnavbar" href="index.php">トップ</a></li>
      <li ><a class="mainnavbar" href="selectwork.php">作品の一覧</a></li>
      <li ><a class="mainnavbar" href="notice.php">お知らせ</a></li>
<!--        管理者のユーザー管理表示-->
<!--
        <?php
            if(
                $_SESSION['kanri_flg']==1
            ) {
                
        ?>
        <li id="list"><a class="mainnavbar" href="selectuser.php">生徒の一覧</a></li>
        <li id="list"><a class="mainnavbar" href="noticekanri.php">お知らせ管理</a></li>
        <li id="list"><a class="mainnavbar" href="registration.php">生徒の登録</a></li>

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
            <li id="list"><a class="mainnavbar" href="login.php">ログイン</a></li>
            <li id="list"><a class="mainnavbar" href="registration.php">ユーザー登録</a> </li>           
        <?php } else { ?>
            <li id="list"><a class="mainnavbar" href="logout.php">ログアウト</a></li>
            <li id="list"><a class="mainnavbar" href="detailuser.php">プロフィール編集</a></li>
            <li id="list"><a class="mainnavbar" href="">
              <?php
                echo 'ようこそ ', $_SESSION['nickname'], ' さん';
                ?>
            </a></li>
        <?php } ?>
      <li id="list"><form class="mainnavbar"  action="searchresult.php" method="post">
        <input type="text" name="search">
        <input type="submit" value="検索">
        </form></li>
      <li id="list"><a class="mainnavbar">お知らせ１</a></li>
      <li id="list"><a class="mainnavbar">お知らせ２</a></li>
      <li id="list"><a class="mainnavbar">お知らせ３</a></li>
      
      </ul>
      </div>
    </div>