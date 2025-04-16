<?php
session_start();
require_once "../Classes/Classes.php";
$id = $_REQUEST["id"];
$classManager = new classmanager();
$result = $classManager->deletecomments($id);
echo $result;
?>