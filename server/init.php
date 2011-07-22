<?php
  session_start();
  ini_set("display_errors", 1);
  
  include $_SERVER['DOCUMENT_ROOT']. "/server/data/DAO/UserDAO.php";
  include $_SERVER['DOCUMENT_ROOT']. "/server/data/DAO/RoomDAO.php";
  include $_SERVER['DOCUMENT_ROOT']. "/server/data/DAO/MessageDAO.php";
  
  function error($msg) {
  	   header('HTTP/1.1 500 '.$msg);
  	   exit();
  }
?>
