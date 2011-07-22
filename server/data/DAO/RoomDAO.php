<?php
include_once $_SERVER['DOCUMENT_ROOT']. '/server/data/VO/RoomVO.php';
include_once $_SERVER['DOCUMENT_ROOT']. '/server/data/DAO/BaseDAO.php';

class RoomDAO extends BaseDAO {
	public function __construct() {
		parent::__construct();
	}

	public function insert(RoomVO $roomVO) {
		$params = array();
		$query = "INSERT INTO ROOM (ROOM_TITLE,
									ROOM_URL ,
									ROOM_HASH ) VALUES (? , ? ,?)";
		$params[] = $roomVO->getRoomTitle();
		$params[] = $roomVO->getRoomURL();
		$params[] = md5($roomVO->getRoomURL());
		if ($this->connMgr->executeUpdate($query, $params))
			return $this->connMgr->getInsertID();
	}

	public function roomExists($roomURL) {
		$params = array();
		$hash = md5($roomURL);
		$query = "SELECT COUNT(*) AS COUNT FROM ROOM WHERE ROOM_HASH = ?";
		$params[] = $hash ;
		$result = $this->connMgr->executeQuery($query, $params);
		return $result[0]['COUNT'];
	}
	
	public function get($roomId) {
		$params = array();
		$query = "SELECT * FROM ROOM WHERE ROOM_ID =? ";
		$params[] = $roomId;
		$result = $this->connMgr->executeQuery($query, $params);
		$room = $result[0] ;
		$roomVO = new RoomVO();
		$roomVO->setRoomId($room['room_id']);
		$roomVO->setRoomTitle($room['room_title']);
		$roomVO->setRoomURL($room['room_url']);
		return $roomVO ;
	}
	
	public function getAll() {
		$params = array();
		$query = "SELECT * FROM ROOM ";
		$result = $this->connMgr->executeQuery($query, $params);
		$rooms = array();
		foreach($room as $result) {
			$roomVO = new RoomVO();
			$roomVO->setRoomId($room['room_id']);
			$roomVO->setRoomTitle($room['room_title']);
			$roomVO->setRoomURL($room['room_url']);
			$rooms[] = $roomVO ;
		}
		return $rooms ;
	}

	public function addUserToRoom($roomId , $userId) {
		$params = array();
		$query = "INSERT INTO ROOM_USER (ROOM_ID , USER_ID) VALUES( ? , ?)";
		$params[] = $roomId ;
		$params[] = $userId ;
		return $this->connMgr->executeUpdate($query, $params);
	}
	
	public function getRoomId($roomURL) {
		$params = array();
		$query = "SELECT ROOM_ID FROM ROOM WHERE ROOM_HASH = ? ";
		$params[] = md5($roomURL) ;
		$result = $this->connMgr->executeQuery($query, $params);
		if ($result)
			return $result[0]['ROOM_ID'] ;
		return false ;
	}
	
	public function getMaxMessageID($roomId) {
		$params = array();
		$query = "SELECT MAX(MESSAGE_ID) AS MAX FROM MESSAGE WHERE ROOM_ID = ?";
		$params[] = $roomId ;
		$result = $this->connMgr->executeQuery($query, $params);
		return $result[0]['MAX'] ;
	}
}