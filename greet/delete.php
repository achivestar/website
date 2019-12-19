<?php
session_start();
if(!isset($_SESSION["userid"])){
    echo "<script>alert('로그인 후 사용하세요');history.back();exit;</script>";
}
require_once("greetDao.php");
$num = $_REQUEST["num"];
if($num){
    $dao =  new greetDao();
    $dao->deleteGreet($num);

}
?>