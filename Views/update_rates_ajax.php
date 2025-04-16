<?php
session_start();
require_once "../Classes/Classes.php";
$userid = '';
$userid = $_SESSION['userid'];
$postid = $_REQUEST["id"]; 
$rate = $_REQUEST["rating"];
$classManager = new classmanager();
$result = $classManager->updaterate($postid,$rate,$userid);
echo $result;
?>