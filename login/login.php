<?php
    session_start();

require_once("membersDao.php");

$id = $_REQUEST["id"];
$pass = $_REQUEST["pass"];
$login = $_REQUEST["login"];
$dao = new MembersDao();
$row = $dao->selectMember($id);

if(!isset($row["id"])){
    echo "<script>alert('등록되지 않은 아이디 입니다.');history.go(-1);</script>";
}else{
    if($row["pass"] != $pass){
        echo "<script>alert('비밀번호가 틀립니다.');history.go(-1);</script>";
        exit();
    }else{
        $userid = $row["id"];
        $username = $row["name"];
        $usernick = $row["nick"];
        $userlevel = $row["level"];

        $_SESSION["userid"] = $userid;
        $_SESSION["username"] = $username;
        $_SESSION["usernick"] = $usernick ;
        $_SESSION["userlevel"] = $userlevel;


        if($login=="memo"){
             echo "<script>location.href='../memo/memo.php';</script>";
        }else if($login=="greet"){
             echo "<script>location.href='../greet/list.php';</script>";
        }else if($login=="free"){
            echo "<script>location.href='../free/list.php';</script>";
        }else if($login=="concert"){
            echo "<script>location.href='../concert/list.php';</script>";
        }else{
            echo "<script>location.href='../login/login_form.php';</script>";
        }


    }

}
?>


