<?php
class UserVO {
	private $userName ;
	private $userId ;
	private $email ;
	private $fullName ;
	
	public function getUserName() { return $this->userName; } 
	public function getUserId() { return $this->userId; } 
	public function getEmail() { return $this->email; } 
	public function getFullName() { return $this->fullName; } 
	
	public function setUserName($x) { $this->userName = $x; } 
	public function setUserId($x) { $this->userId = $x; } 
	public function setEmail($x) { $this->email = $x; } 
	public function setFullName($x) { $this->fullName = $x; }
	
}