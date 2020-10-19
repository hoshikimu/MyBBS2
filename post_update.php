<?PHP
  require_once('dbc.php');

  date_default_timezone_set('Asia/Tokyo');
  $posts = $_POST;

  if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
  isset($_POST['message']) &&
  isset($_POST['user'])) {
    $postedAt = date('Y-m-d H:i:s');
  }

  $dbc = new Dbc();
  $dbc->postValidate($posts);
  $dbc->postUpdate($posts, $postedAt);
?>
<p><a href="/MyBBS2/">戻る</a></p>