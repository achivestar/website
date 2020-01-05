<?php
require_once("surveyDao.php");
$composer = $_REQUEST['composer'];
$id = $_REQUEST["id"];
//echo $composer.",".$id;
$dao = new surveyDao();
$row = $dao->update($id,$composer);
?>