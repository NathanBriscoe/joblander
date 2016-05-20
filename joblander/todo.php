<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>To Do</title>
    <link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Arimo|Shadows+Into+Light' rel='stylesheet'>
    <link rel='stylesheet' href='css/main.css'>
    <meta name='viewport' content='width=device-width, inital-scale=1.0'>
  </head>

  <body>
    <div class="list">
      <h1 class='header'>To do.</h1>
      <ul>
        <li><span class='item'>Apply to 15-30 jobs this week</span></li>
        <li><span class='item done'>Learn Php</span></li>

        <form class="item-add" action="add.php" method="post">
          <input type="text" name="name" placeholder="Add a to-do here" class="input" autocomplete="off" required>
          <input type="submit" value="Add" class="submit">
        </form>  

      </ul>

    </div>

  </body>

</hmtl>
