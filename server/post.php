<?php
require_once 'init.php';

$message = $_REQUEST['message'];
$userId = $_REQUEST['user_id'];
$roomId = $_REQUEST['room_id'];

$messageDAO = new MessageDAO();
$messageVO = new MessageVO();

$messageVO->setMessageText($message);
$messageVO->setRoomId($roomId);
$messageVO->setUserId($userId);

$messageDAO->insert($messageVO);

