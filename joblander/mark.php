<?php
//we are requiring the file init.php here to start a session
  require_once 'app/init.php';
//
  if(isset($_GET['as'], $_GET['item'])) {
    $as = $_GET['as'];
    $item = $_GET['item'];
// well use a Switch here in order to turn the switch on and off. Turning done to not done or reverse
//case is one of many potential options to the switch, break stops from checking other switches when a particular switch is selected
    switch($as) {
      case 'done':
        $doneQuery = $db->prepare("
            UPDATE items SET done = 1 WHERE id = :item AND user = :user
        ");
        $doneQuery->execute([
            'item' => $item,
            'user' => $_SESSION['user_id']
        ]);
      break;
      case 'done':
        $doneQuery = $db->prepare("
            UPDATE items SET done = 0 WHERE id = :item AND user = :user
        ");
        $doneQuery->execute([
            'item' => $item,
            'user' => $_SESSION['user_id']
        ]);
      break;
    }
  }
// redirect user back to index.php
header('Location: index.php');
 ?>
