<?php
require_once 'init.php';

$username = $_REQUEST['username'];

$userDAO = new UserDAO();

if ($userVO = $userDAO->getByUsername($username)) {
	header('Content-type: application/json');
	echo "{ \"user_id\" : \"{$userVO->getUserId()}\"}";
} else {
	header('HTTP/1.1 500 Internal Server Error');
	echo $userDAO->getError();
}