<?php
  function dbConnect() {
    $dsn = 'mysql:host=localhost;dbname=MyBBS;charset=utf8';
    $user = 'bbs_user';
    $pass = 'hogehogebbs';

    try {
      $dbh = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      ]);
    } catch(PODException $e) {
      echo '接続失敗' . $e->getMessage();
      exit();
    };
    return $dbh;
  }

  function getAllPosts() {
    $dbh = dbConnect();
    $sql = 'SELECT * FROM posts';
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
    $dbh = null;
  }
?>