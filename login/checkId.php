<?php
require_once("membersDao.php");

$idCheck = $_REQUEST["idCheck"];

if($idCheck){
    $dao = new MembersDao();
    $row = $dao->selectMember($idCheck);
    if(isset($row["id"])){
       echo "1";
    }else{
       echo "0";
    }
}
?>

