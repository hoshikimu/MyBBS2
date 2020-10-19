<?php
  require_once('dbc.php');

  date_default_timezone_set('Asia/Tokyo');
  $posts = $_POST;

  if (empty($posts['user'])) {
    exit('ユーザー名を入力してください');
  }

  if (mb_strlen($posts['user']) > 11) {
    exit('10文字以下にしてください');
  }

  if (empty($posts['message'])) {
    exit('本文を入力してください');
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
  isset($_POST['message']) &&
  isset($_POST['user'])) {
    $postedAt = date('Y-m-d H:i:s');
  }

  $sql = 'INSERT INTO
            posts(user, message, post_at)
          VALUES
            (:user, :message, :post_at)';

  $dbh = dbConnect();
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
?>