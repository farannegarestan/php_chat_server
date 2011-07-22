<?php
require_once 'init.php';

$roomURL = $_REQUEST['room_id'];
// get chat room 

$userDAO = new UserDAO();
$users = $userDAO->getRoomUsers($roomID);

$out = "[ ";
foreach($users as $user) {
	if(strlen($out) > 5) $out .= ",";
	$out .= " { \"user_name\" : \"{$user->getUserName()}\" , \"user_id\" : \"{$user->getUserId()}\" }";
}
$out .= " ]";
header('Content-type: application/json');
echo $out ;


