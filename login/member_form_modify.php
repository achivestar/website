<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bluering 연주회</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <style>
        @media screen and (max-width: 568px) {
            .lmenu {
                display: none
            }
        }
    </style>
    <script>


        function check_input() {

            if(!document.member_form.id.value){
                document.getElementById("idValid").innerText="아이디를 입력하세요.";
                document.member_form.id.focus();
                return false;
            }else{
                document.getElementById("idValid").innerText="";
            }

            if(!document.member_form.pass.value){
                document.getElementById("pwValid").innerText="비밀번호를 입력하세요.";
                document.member_form.pass.focus();
                return false;
            }else{
                document.getElementById("pwValid").innerText="";
            }

            if(!document.member_form.pass_confirm.value){
                document.getElementById("rpwValid").innerText="비번 재입력을 입력하세요.";
                document.member_form.pass_confirm.focus();
                return false;
            }else{
                document.getElementById("rpwValid").innerText="";
            }

            if(!document.member_form.name.value){
                document.getElementById("nameValid").innerText="이름을 입력하세요.";
                document.member_form.name.focus();
                return false;
            }else{
                document.getElementById("nameValid").innerText="";
            }

            if(!document.member_form.email.value){
                document.getElementById("emailValid").innerText="이메일을 입력하세요.";
                document.member_form.email.focus();
                return false;
            }else{
                document.getElementById("emailValid").innerText="";
            }

            if(!document.member_form.nick.value){
                document.getElementById("nickValid").innerText="닉네임을 입력하세요.";
                document.member_form.nick.focus();
                return false;
            }else{
                document.getElementById("nickValid").innerText="";
            }




            var emailRegExp = /^[A-Za-z0-9_]+[A-Za-z0-9]*[@]{1}[A-Za-z0-9]+[A-Za-z0-9]*[.]{1}[A-Za-z]{1,3}$/;
            if (!emailRegExp.test(document.getElementById("email").value)) {
                document.getElementById("emailValid").innerText="이메일 형식이 올바르지 않습니다.";
                document.member_form.email.focus();
                return false;
            }

            var idRegExp = /^[a-zA-z0-9]{4,12}$/; //아이디 유효성 검사
            if (!idRegExp.test(document.getElementById("id").value)) {
                document.getElementById("idValid").innerText="아이디는 영문 또는 숫자로 4~12자리로 입력하세요.";
                document.member_form.id.focus();
                return false;
            }

            if (document.getElementById("id").value == document.getElementById("pw").value) {
                alert("아이디와 비밀번호는 같을 수 없습니다!");
                return false;
            }


            if (document.member_form.pass.value != document.member_form.pass_confirm.value) {
                document.getElementById("pwValid").innerText="비밀번호가 서로 일치하지 않습니다.";
                document.member_form.pass.focus();
                document.member_form.pass.select();
                return false;
            }



        }

        function checkId() {
            $.ajax({
                url: 'checkId.php',
                type: 'POST',
                data: {'idCheck':$('#id').val()},
                dataType: 'html',
                success: function(data){

                    if(data==1){
                        document.getElementById("idValid").innerText="이미 사용중인 아이디 입니다";
                        document.member_form.id.focus();
                        return false;
                    }else if(data==0){
                        document.getElementById("idValid").innerHTML="<span style='color:green'>사용가능한 아이디 입니다</span>";
                    }

                }
            });
        }

        function checkNick() {
            $.ajax({
                url: 'checkNick.php',
                type: 'POST',
                data: {'nickCheck':$('#nick').val()},
                dataType: 'html',
                success: function(data){

                    if(data==1){
                        document.getElementById("nickValid").innerText="이미 사용중인  닉네임 입니다";
                        document.member_form.nick.focus();
                        return false;
                    }else if(data==0){
                        document.getElementById("nickValid").innerHTML="<span style='color:green'>사용가능한 닉네임 입니다</span>";
                    }

                }
            });
        }
    </script>
</head>
<body>
<!--jumbotron 부분-->
<div class="container">
    <?php
    include "../lib/top_login_sub.php";
    include "../lib/top_menu_sub.php";
    include "membersDao.php";
    if($_SESSION["userid"]){
        $dao = new MembersDao();
        $row = $dao->selectMember($_SESSION["userid"]);
        $hp = explode("-",$row["hp"]);
        $hp1 = $hp[0];
        $hp2 = $hp[1];
        $hp3 = $hp[2];
    }
    ?>
    <div class="row">
        <div class="col-sm-4 lmenu">
            <br>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">낙서장</a>
                <a href="#" class="list-group-item list-group-item-action">가입인사</a>
                <a href="#" class="list-group-item list-group-item-action">연주회소개</a>
                <a href="#" class="list-group-item list-group-item-action">자료실</a>
                <a href="#" class="list-group-item list-group-item-action">자유게시판</a>
                <a href="#" class="list-group-item list-group-item-action">레슨문의</a>
                <a href="#" class="list-group-item list-group-item-action">설문조사</a>
            </div>
        </div>
        <div class="col-sm-8 col-12">
            <br>
            <h2>회원정보수정</h2>
            <br><br>
            <form action="modify.php" method="post" name="member_form" onsubmit="return check_input()">
                <div class="form-group">
                    <label for="id">ID :</label>
                    <div class="form-check-inline">
                        <label class="form-check-label"><input type="text" class="form-control" id="id"
                                                             value="<?=$row["id"]?>" name="id" readonly
                                                               size="80" ></label>

                    </div>
                    <p id="idValid" style="color:red;font-size: 12px"></p>
                </div>
                <br>
                <div class="form-group">
                    <label for="pw">비밀번호 :</label>
                    <div class="form-check-inline">
                        <input type="password" class="form-control" id="pw"  value="<?=$row["pass"]?>" name="pass"  size="73">
                    </div>
                    <p id="pwValid" style="color:red;font-size: 12px"></p>
                </div>
                <br>
                <div class="form-group">
                    <label for="pw_confirm">비번확인 :</label>
                    <div class="form-check-inline">
                        <input type="password" class="form-control" id="pw_confirm"  value="<?=$row["pass"]?>"
                               name="pass_confirm" size="73">
                    </div>
                    <p id="rpwValid" style="color:red;font-size: 12px"></p>
                </div>
                <br>
                <div class="form-group">

                    <label for="name">이름 :</label>
                    <div class="form-check-inline">
                        <label class="form-check-label"><input type="text" class="form-control" id="name"
                                                               value="<?=$row["name"]?>" name="name" size="80"></label>
                    </div>
                    <p id="nameValid" style="color:red;font-size: 12px"></p>
                </div>
                <br>
                <div class="form-group">
                    <label for="nick">닉네임 :</label>
                    <div class="form-check-inline">
                        <label class="form-check-label"> <input type="text" class="form-control" id="nick"
                                                                value="<?=$row["nick"]?>" name="nick" size="80"
                                                                onblur="checkNick()"></label>
                    </div>
                    <p id="nickValid" style="color:red;font-size: 12px"></p>
                </div>
                <br>
                <div class="form-group">
                    <label for="phone">연락처 :</label>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <select class="form-control" id="sel1" name="hp1">

                                <option> 통신사</option>
                                <option value = "010" <?php if($hp1=='010') { echo "selected";}?>> 010</option >
                                <option value = "016" <?php if($hp1=='016') { echo "selected";}?>> 016</option >
                                <option value = "017" <?php if($hp1=='017') { echo "selected";}?>> 017</option >
                                <option value = "018" <?php if($hp1=='018') { echo "selected";}?>> 018</option >
                                <option value = "019" <?php if($hp1=='019') { echo "selected";}?>> 019</option >

                            </select>
                        </label> -
                        <label class="form-check-label">
                            <input type="text" class="form-control" name="hp2" value="<?=$hp2?>" maxlength="4"
                            >
                        </label> -
                        <label class="form-check-label">
                            <input type="text" class="form-control" name="hp3" value="<?=$hp3?>" maxlength="4"
                            >
                        </label>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="email">이메일 :</label>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="text" class="form-control" id="email"
                                   value="<?=$row["email"]?>" name="email"
                                   size="80"  ></label>
                    </div>
                    <p id="emailValid" style="color:red;font-size: 12px"></p>
                </div>
                <br><br>
                <div class="form-group" style="text-align: center">
                    <input type="submit" class="btn btn-primary" value="수정하기" />
                    <input type="reset" class="btn btn-secondary" value="취소하기" />
                </div>

            </form>
        </div>
    </div>
    <br><br>
</div>

</body>
</html>
