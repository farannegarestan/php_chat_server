<?php
require("init.php");

$userId = $_REQUEST['user_id'];
$roomId = $_REQUEST['room_id'];
$lastUpdate = $_REQUEST['last_update'];

$messageDAO = new MessageDAO();

$result = $messageDAO->getLatestMessage($roomId, $lastUpdate);

$out = "[ " ;
$t = $lastUpdate ;
foreach($result as $row) {
	if (strlen($out) > 5) $out.= ",";
	$out .= "{ ";
	$out .= "\"message_text\" : \"{$row['message_text']}\" , ";
	$out .= "\"user_id\" : \"{$row['user_id']}\"";
	$out .= " }";
	$t = $row['message_id'];
}
$out .= " ]";

$userDAO = new UserDAO();
$users = $userDAO->getRoomUsers($roomId);

$out1 = "[ ";
foreach($users as $user) {
	if(strlen($out1) > 5) $out1 .= ",";
	$out1 .= " { \"user_name\" : \"{$user->getUserName()}\" , \"user_id\" : \"{$user->getUserId()}\" }";
}
$out1 .= " ]";



$userDAO = new UserDAO();
$userDAO->setLastUpdate($userId);

//$t = time() ;
header('Content-type: application/json');
echo "{ \"messages\" : $out , \"users\" : $out1 , \"last_update\": \"$t\" }" ;