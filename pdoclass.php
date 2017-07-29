<?php
/**
 * Class DB
 */
class DB {

  protected $pdo;
  protected $stmt;

  /**
   * @param $host
   * @param $dbname
   * @param $user
   * @param $password
   */
  public function db_con($host, $port, $dbname, $user, $password ) {
    try {
      $this->pdo = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$dbname, $user, $password ,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
      $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $this->pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
    } catch (Exception $e) {
      print "エラー!!:". $e->getMessage() . "<br/>";
    }

    return $pdo;
  }

  /**
   * @param $sql
   * @return array $stmt
   */
  function pdoQuery($sql){
    $stmt = $this->pdo->query($sql);
    foreach ($stmt as $row) {
      $res[] = $row;
    }

    return $res;
  }

  /**
   * @param string $sql
   * @param array  $arr
   * @param int    $mode SELECTの時は1,それ以外の時は2
   *
   * @return array $stmt
   */
  function pdoPrepare($sql,$arr,$mode){
    $stmt = $this->pdo->prepare($sql);
    foreach ($arr as $key => $val) {
      $k = $key+1;
      if(is_int($val)){
          $val = (int)$val;
          $stmt->bindValue($k,$val,PDO::PARAM_INT);
      }else{
          $val = (string)$val;
          $stmt->bindValue($k,$val,PDO::PARAM_STR);
      }
    }

    $stmt->execute();

    if($mode == 1){

      foreach ($stmt as $row) {
        $res[] = $row;
      }

      return $res;

    }else{

      return true;
    }

  }


}