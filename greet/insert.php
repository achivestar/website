<?php
session_start();
if(!isset($_SESSION["userid"])){
    echo "<script>alert('로그인 후 사용하세요');history.back();exit;</script>";
}
require_once("greetDao.php");
require_once("../login/membersDao.php");
$id = $_SESSION["userid"];
$daoMembers = new membersDao();
$row = $daoMembers->selectMember($id);
$name = $row["name"];
$nick = $row["nick"];
$subject = $_REQUEST["subject"];
$hit = 0;
$html_ok = $_REQUEST["html_ok"];
if($html_ok=="y"){
    $is_html = "y";
}else{
    $is_html = "";
}
$content = $_REQUEST["content"];
$regist_day =date("Y-m-d H:i:s");

if($content){
    $dao =  new greetDao();
    $dao->insertGreet($id,$name,$nick,$subject,$content,$regist_day,$hit,$is_html);

}
?>