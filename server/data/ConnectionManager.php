<?php
ini_set("display_errors", 1);

class ConectionManager {
	private $conn ;
	private $stmt ;

	public function __construct() {
		$this->conn = new mysqli('localhost','root','diadic','chat');
	}

	public function executeQuery($query , $params) {
		//echo $query;
		$result = array();
		$stmt = $this->conn->prepare($query);
		if (count($params) > 0) {
			$type = str_repeat("s", count($params));
			call_user_func_array('mysqli_stmt_bind_param', array_merge(array($stmt, $type), $this->makeValuesReferenced($params)));
		}
		$stmt->execute();
		$meta = $stmt->result_metadata();
		$fields = array();
		while($field = $meta->fetch_field())
			$fields[] = &$row[$field->name];
		call_user_func_array(array($stmt , "bind_result"), $fields);
	    while ( $stmt->fetch() ) {  
	       $x = array();  
	       foreach( $row as $key => $val ) {  
	          $x[$key] = $val;  
	       }  
	       $result[] = $x; 
	    } 
	    return $result ;
	}

	public function executeUpdate($query , $params) {
		$this->stmt = $this->conn->prepare($query);
		$type = str_repeat("s", count($params));
		$stmt = $this->stmt ;
		call_user_func_array('mysqli_stmt_bind_param', array_merge(array($stmt, $type), $this->makeValuesReferenced($params)));
		return $this->stmt->execute();
	}

	public function __destruct() {
		$this->conn->close();
	}
	
	
	private function makeValuesReferenced($arr){
		$refs = array();
		foreach($arr as $key => $value)
		$refs[$key] = &$arr[$key];
		return $refs;
	
	}
	
	public function getInsertID() {
		return mysqli_stmt_insert_id($this->stmt);
	}
	
	public function getError() {
		return $this->conn->error();
	}
}


