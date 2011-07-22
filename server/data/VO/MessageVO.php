<?php
/**
 * Enter description here ...
 * @author faran
 *
 */
class MessageVO {
	private $messageText ;
	private $userId ;
	private $timestmap ;
	private $roomId ;
	
	public function getMessageText() { return $this->messageText; } 
	public function getUserId() { return $this->userId; } 
	public function getTimestmap() { return $this->timestmap; } 
	public function getRoomId() { return $this->roomId; }
	
	public function setMessageText($x) { $this->messageText = $x; } 
	public function setUserId($x) { $this->userId = $x; } 
	public function setTimestmap($x) { $this->timestmap = $x; } 
	public function setRoomId($x) { $this->roomId = $x; } 
}