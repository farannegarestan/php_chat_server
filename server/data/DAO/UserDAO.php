<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/server/data/VO/UserVO.php';
include_once $_SERVER['DOCUMENT_ROOT']. '/server/data/DAO/BaseDAO.php';

class UserDAO extends BaseDAO {
	
	public function __construct() {
		 parent::__construct();
	}
	
	public function insert(UserVO $userVO) {
		$params = array();
		$query = "INSERT INTO USER (email,
									user_name ,
									full_name ) values (? , ? ,?)";
		$params[] = $userVO->getEmail();
		$params[] = $userVO->getUserName();
		$params[] = $userVO->getFullName();
		return $this->connMgr->executeUpdate($query, $params);
	}
	
	public function get($userID) {
		$params = array();
		$query = "SELECT * FROM USER WHERE USER_ID = ?";
		$params[] = $userID ;
		$result = $this->connMgr->executeQuery($query, $params);
		$row = $result[0] ;
		
		$vo = new UserVO();
		$vo->setUserId($row['user_id']);
		$vo->setEmail($row['email']);
		$vo->setFullName($row['full_name']);
		$vo->setUserName($row['user_name']);
		return $vo ;
	}
	
	public function getByUsername($username) {
		$params = array();
		$query = "SELECT * FROM USER WHERE USER_NAME = ?";
		$params[] = $username ;
		$result = $this->connMgr->executeQuery($query, $params);
		$row = $result[0] ;
		
		$vo = new UserVO();
		$vo->setUserId($row['user_id']);
		$vo->setEmail($row['email']);
		$vo->setFullName($row['full_name']);
		$vo->setUserName($row['user_name']);
		return $vo ;
	}
	
	public function getRoomUsers($roomID) {
		$params = array();
		$query = "SELECT * FROM USER
						WHERE USER_ID IN (SELECT USER_ID FROM ROOM_USER WHERE ROOM_ID = ?)";
		$params[] = $roomID;
		$result = $this->connMgr->executeQuery($query, $params);
		
		$users = array();
		foreach($result as $row){
			$vo = new UserVO();
			$vo->setUserId($row['user_id']);
			$vo->setEmail($row['email']);
			$vo->setFullName($row['full_name']);
			$vo->setUserName($row['user_name']);
			$users[] = $vo ;
		}
		return $users ;
	}
	
	public function setLastUpdate($userID) {
		$params = array();
		$query = "UPDATE USER SET LAST_UPDATE = NOW() WHERE USER_ID = ?";
		$params[] = $userID ;
		return $this->connMgr->executeUpdate($query, $params);
	}
	/**
	 * 
	 * Inserts the new user and returns the user_id
	 * @param unknown_type $email
	 * @param unknown_type $username
	 */
	public function addUser($email , $username) {
		$params = array();
		$query = "INSERT INTO USER (USER_NAME , EMAIL , FULL_NAME) VALUES (? ,? ,? ) ";
		$params[] = $username ;
		$params[] = $email ;
		$params[] = "" ;
		if ($this->connMgr->executeUpdate($query, $params)) {
			return $this->connMgr->getInsertID();
		} else {
			return false ;
		}
	}
}