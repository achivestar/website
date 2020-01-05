<?php
require_once("freeDao.php");
$dao =  new freeDao();
$num = $_REQUEST["num"];
$parent = $_REQUEST["parent"];
if($num){
    $dao->deleteFreeRipple($parent,$num);
}
?>