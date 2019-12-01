<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
    echo "<div class='alert alert-success' style=\"height: 150px;text-align: center;line-height:130px;\">
                <strong>메모를 저장하였습니다!</strong>
            </div>";
    header("Refresh: 1; URL=../index.php");
    exit();
}else{
    echo "<div class='alert alert-danger' style=\"height: 150px;text-align: center;line-height:130px;\">
    <strong>메모 저장에 실패하였습니다!</strong>
    </div>";
    header("Refresh: 1; URL=../index.php");
    exit();
}


?>