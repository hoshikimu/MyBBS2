<?php
  require_once('dbc.php');

  $dbc = new Dbc();
  $result = $dbc->postDelete($_GET['id']);
?>
<p><a href="/MyBBS2/">戻る</a></p>