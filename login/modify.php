<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<?php
    session_start();
    include_once ("membersDao.php");

    $id = $_REQUEST["id"];
    $pass = $_REQUEST["pass"];
    $name = $_REQUEST["name"];
    $_SESSION["usernick"] = $_REQUEST["nick"];
    $hp = $_REQUEST["hp1"]."-".$_REQUEST["hp2"]."-".$_REQUEST["hp3"];
    $email = $_REQUEST["email"];
    $regist_day = date("Y-m-d H:i:s");


    $dao =  new MembersDao();
    $dao->updateMember($id,$pass,$name,$_SESSION["usernick"],$hp,$email,$regist_day);

    echo "<div class='alert alert-success' style=\"height: 150px;text-align: center;line-height:130px;\">
                    <strong>회원정보를  수정 하였습니다!</strong>
                </div>";
    header("Refresh: 2; URL=../index.php");
?>