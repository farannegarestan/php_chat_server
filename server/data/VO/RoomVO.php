<?php
class RoomVO {
	private $roomId ;
	private $roomURL ;
	private $roomHash ;
	private $roomTitle ;
	
	public function getRoomId() { return $this->roomId; } 
	public function getRoomURL() { return $this->roomURL; } 
	public function getRoomHash() { return $this->roomHash; } 
	public function getRoomTitle() { return $this->roomTitle; } 
	
	public function setRoomId($x) { $this->roomId = $x; } 
	public function setRoomURL($x) { $this->roomURL = $x; } 
	public function setRoomHash($x) { $this->roomHash = $x; } 
	public function setRoomTitle($x) { $this->roomTitle = $x; }
}