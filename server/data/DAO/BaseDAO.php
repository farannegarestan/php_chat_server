<?php

include_once  $_SERVER['DOCUMENT_ROOT']. '/server/data/ConnectionManager.php';

class BaseDAO {
	protected $connMgr ;
	
	protected function __construct() {
		$this->connMgr = new ConectionManager();
	}
	
	public function getError() {
		return $this->connMgr->getError();
	}
}