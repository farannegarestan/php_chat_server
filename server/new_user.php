<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/server/init.php';

$username = $_REQUEST['username'];
$email = $_REQUEST['email'];

$userDAO = new UserDAO();

$userID = $userDAO->addUser($email, $username);
if ($userID) {
	header('Content-type: application/json');
	echo "{ \"user_id\" : \"$userID\"}";
} else {
	header('HTTP/1.1 500 Internal Server Error');
	echo $userDAO->getError();
}

