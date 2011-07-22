<?php
require_once 'init.php';

$userId = $_REQUEST['user_id'];
$roomURL = $_REQUEST['room_url']; 

$roomDAO = new RoomDAO() ;
$roomId = $roomDAO->getRoomId($roomURL);
if (!$roomId) {
	$roomVO = new RoomVO();
	$roomVO->setRoomURL($roomURL);
	$roomVO->setRoomTitle("");
	$roomId = $roomDAO->insert($roomVO);
}
$roomDAO->addUserToRoom($roomId, $userId);

$t = $roomDAO->getMaxMessageID($roomId) ;
header('Content-type: application/json');
$out = "{ \"last_update\" : \"$t\" , \"room_id\":\"$roomId\" }" ;
echo $out ;


