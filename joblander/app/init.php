<?php

session_start();

$_SESSION['user_id'] = 1;

$db = new PDO('mysql:dbname=joblanderDB;host=localhost', 'root', 'root');

//Handle this in some other way
//the below statement is asking if the user is logged in, is it set?
if(!isset($_SESSION['user_id'])) {
  die('You are not signed in.');
}

 ?>
