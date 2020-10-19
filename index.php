<?php
  require_once('dbc.php');
  $postsData = getAllPosts();
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
      <p class="h-logo">MyBBS2</p>
    </nav>
  </header>
  <main>
    <div class="container">
      <form action="post_create.php" method="post" class="form-container">
        <span class="form-title">投稿者</span><input type="text" name="user"><br>
        <span class="form-title">本　文</span><textarea type="text" name="message"></textarea><br>
        <input type="submit" value="投稿" class="btn">
      </form>
      <div class="post-container">
        <h3>　投稿一覧（全<?php echo count($postsData) ?>件）</h3>
        <div class="posts-table">
          <table>
            <?php if (count($postsData)) : ?>
              <tr><th class="post-user">投稿者</th><th class="post-at">投稿日時</th><th class="post-message">本文</th></tr>
              <?php foreach ($postsData as $column) : ?>
                <tr><td><?php echo $column['user']; ?></td><td><?php echo $column['post_at']; ?></td><td><?php echo $column['message']; ?></td></tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr><td class="non-post">まだ投稿はありません。</td></tr>
            <?php endif; ?>
            </table>
        </div>
      </div>
    </div>
  </main>
  </div>
</body>
</html>