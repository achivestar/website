<?php
 session_start();
 if(!isset($_SESSION["userid"])){
     echo "<script>alert('로그인 후 사용하세요');history.back();exit;</script>";
 }
require_once("memoDao.php");
require_once("../login/membersDao.php");
$id = $_SESSION["userid"];
$daoMembers = new membersDao();
$row = $daoMembers->selectMember($id);
$name = $row["name"];
$nick = $row["nick"];
$content = $_REQUEST["content"];
$regist_day =date("Y-m-d H:i:s");

if($content){

    $dao =  new memoDao();
    $dao->insertMemo($id,$name,$nick,$content,$regist_day);
   //header("Location:memo.php");
}
?>