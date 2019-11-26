<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<?php
require_once("membersDao.php");

$id = $_REQUEST["id"];
$pass = $_REQUEST["pass"];
$name = $_REQUEST["name"];
$nick = $_REQUEST["nick"];
$hp = $_REQUEST["hp1"]." 010-".$_REQUEST["hp2"]."-".$_REQUEST["hp3"];
$email = $_REQUEST["email"];
$regist_day = $_REQUEST["regist_day"];
$level = $_REQUEST["level"];

if($id && $pass && $name && $nick && $hp && $email){
    $dao =  new MembersDao();
    $dao->insertMember($id,$pass,$name,$nick,$hp,$email,$regist_day,$level);
    echo "<div class='alert alert-success' style=\"height: 150px;text-align: center;line-height:130px;\">
                <strong>회원가입을 하였습니다!</strong>
            </div>";
    header("Refresh: 2; URL=../index.php");
    exit();
}else{
    echo "<div class='alert alert-danger' style=\"height: 150px;text-align: center;line-height:130px;\">
    <strong>회원가입에 실패하였습니다!</strong>
    </div>";
    header("Refresh: 2; URL=../index.php");
    exit();
}


?>