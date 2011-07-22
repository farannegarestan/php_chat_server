<?php
include "server/data/DAO/UserDAO.php";
include "server/data/DAO/RoomDAO.php";

/*$userDAO = new UserDAO();

$userVO = new UserVO();

$userVO->setUserName("faran");
$userVO->setEmail("faraneg1@umbc.edu");
$userDAO->insert($userVO); */

$roomDAO = new RoomDAO();

$vo = new RoomVO();
$vo->setRoomURL("www.google.com");
$vo->setRoomTitle("Google!");
//$roomDAO->insert($vo);
echo "inserted!<br/>";

//echo $roomDAO->roomExists("www.google.com");
print_r($roomDAO->getAll());
