<?php
session_start();
require_once "../Classes/Classes.php";
$userid = $_SESSION['userid'];
$id = $_REQUEST["id"];
$comment = $_REQUEST["comment"];
$classManager = new classmanager();
$result = $classManager->addcomment($comment,$id,$userid);
echo $result;
?>