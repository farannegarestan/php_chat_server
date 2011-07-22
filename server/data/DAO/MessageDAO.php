<?php

include_once $_SERVER['DOCUMENT_ROOT']. '/server/data/VO/MessageVO.php';
include_once $_SERVER['DOCUMENT_ROOT']. '/server/data/DAO/BaseDAO.php';


class MessageDAO extends BaseDAO {
	
	public function __construct() {
		 parent::__construct();
	}
	
	public function insert(MessageVO $messageVO) {
		$params = array();
		$query = "INSERT INTO MESSAGE (MESSAGE_TEXT,
									   USER_ID ,
									   ROOM_ID ) VALUES (? , ? ,?)";
		$params[] = $messageVO->getMessageText();
		$params[] = $messageVO->getUserId();
		$params[] = $messageVO->getRoomId();
		return $this->connMgr->executeUpdate($query, $params);
	}
	
	public function getLatestMessage($roomId , $lastUpdate) {
		$params = array();
		$query = "SELECT * FROM MESSAGE WHERE ROOM_ID = ? AND MESSAGE_ID > ? ORDER BY MESSAGE_ID " ;
		$params[] = $roomId ;
		$params[] = $lastUpdate ;
		return $this->connMgr->executeQuery($query, $params);
	}
	
	
}