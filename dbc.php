<?php

  Class Dbc {
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
      $dbh = $this->dbConnect();
      $sql = 'SELECT * FROM posts';
      $stmt = $dbh->query($sql);
      $result = $stmt->fetchall(PDO::FETCH_ASSOC);
      return $result;
      $dbh = null;
    }

    function postCreate($posts, $postedAt) {
      $sql = 'INSERT INTO
            posts(user, message, post_at)
          VALUES
            (:user, :message, :post_at)';

      $dbh = $this->dbConnect();
      $dbh->beginTransaction();

      try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':user', $posts['user'], PDO::PARAM_STR);
        $stmt->bindValue(':message', $posts['message'], PDO::PARAM_STR);
        $stmt->bindValue(':post_at', $postedAt, PDO::PARAM_STR);
        $stmt->execute();
        $dbh->commit();
        echo '投稿に成功しました！';
      } catch(PODException $e) {
        $dbh->rollBack();
        exit($e);
      }
    }
  }
?>