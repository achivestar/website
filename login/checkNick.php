<?php
require_once("membersDao.php");

$nickCheck = $_REQUEST["nickCheck"];

if($nickCheck){
    $dao = new MembersDao();
    $row = $dao->selectNick($nickCheck);
    if(isset($row["nick"])){
        echo "1";
    }else{
        echo "0";
    }
}
?>

