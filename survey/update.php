<?php
require_once("surveyDao.php");
$num = $_REQUEST["num"];
if($num==1){
    $composer1 = $_REQUEST['composer1'];
    $dao = new surveyDao();
    $row = $dao->update($num,$composer1);
}
if($num==2){
    $composer2 = $_REQUEST['composer2'];
    $dao = new surveyDao();
    $row = $dao->update($num,$composer2);
}




?>