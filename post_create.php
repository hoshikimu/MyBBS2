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

  $dbc = new Dbc();
  $dbc->postCreate($posts, $postedAt);
?>