<?php
  require_once('dbc.php');

  $dbc = new Dbc();
  $result = $dbc->getPost($_GET['id']);

  $id = $result['id'];
  $user = $result['user'];
  $message = $result['message'];
  $post_at = $result['post_at'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>MyBBS</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <header>
    <nav>
      <a href="/MyBBS2/index.php" class="h-logo">MyBBS2</a>
    </nav>
  </header>
  <main>
    <div class="container">
    <h3 class="edit-title">編集フォーム</h3>
      <form action="post_update.php" method="post" class="form-container">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <span class="form-title">投稿者</span><input type="text" name="user" value="<?php echo $user ?>"><br>
        <span class="form-title">本　文</span><textarea type="text" name="message"><?php echo $message ?></textarea><br>
        <input type="submit" value="更新" class="btn">
      </form>
    </div>
  </main>
</body>
</html>