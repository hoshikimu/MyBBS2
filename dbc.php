<?php

  Class Dbc {
    public function dbConnect() {
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

    public function getAllPosts() {
      $dbh = $this->dbConnect();
      $sql = 'SELECT * FROM posts';
      $stmt = $dbh->query($sql);
      $result = $stmt->fetchall(PDO::FETCH_ASSOC);
      return $result;
      $dbh = null;
    }

    public function postCreate($posts, $postedAt) {
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

    public function postUpdate($posts, $postedAt) {
      $sql = 'UPDATE posts SET
            user = :user, message = :message, post_at = :post_at
          WHERE
            id = :id';

      $dbh = $this->dbConnect();
      $dbh->beginTransaction();

      try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':user', $posts['user'], PDO::PARAM_STR);
        $stmt->bindValue(':message', $posts['message'], PDO::PARAM_STR);
        $stmt->bindValue(':post_at', $postedAt, PDO::PARAM_STR);
        $stmt->bindValue(':id', $posts['id'], PDO::PARAM_STR);
        $stmt->execute();
        $dbh->commit();
        echo '投稿を更新しました！';
      } catch(PODException $e) {
        $dbh->rollBack();
        exit($e);
      }
    }

    public function postValidate($posts) {
      if (empty($posts['user'])) {
        exit('ユーザー名を入力してください');
      }

      if (mb_strlen($posts['user']) > 11) {
        exit('10文字以下にしてください');
      }

      if (empty($posts['message'])) {
        exit('本文を入力してください');
      }
    }

    public function getPost($id) {
      if (empty($id)) {
        exit('IDが不正です。');
      }

      $dbh = $this->dbConnect();

      $stmt = $dbh->prepare('SELECT * FROM posts Where id = :id');
      $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$result) {
        exit('投稿がありません');
      }

      return $result;
    }
  }
?>