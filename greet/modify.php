<?php
session_start();
if(!isset($_SESSION["userid"])){
    echo "<script>alert('로그인 후 사용하세요');history.back();exit;</script>";
}
require_once("greetDao.php");
require_once("../login/membersDao.php");
$id = $_SESSION["userid"];
$subject = $_REQUEST["subject"];
$content = $_REQUEST["content"];
$regist_day =date("Y-m-d H:i:s");
$num = $_REQUEST["num"];
if($content){
    $dao =  new greetDao();
    $dao->modifyGreet($subject,$content,$regist_day,$num);

}
?>