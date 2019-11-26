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

            var emailRegExp = /^[A-Za-z0-9_]+[A-Za-z0-9]*[@]{1}[A-Za-z0-9]+[A-Za-z0-9]*[.]{1}[A-Za-z]{1,3}$/;
            if (!emailRegExp.test(document.getElementById("email").value)) {
                alert("이메일 형식이 올바르지 않습니다!");
                return false;
            }

            var idRegExp = /^[a-zA-z0-9]{4,12}$/; //아이디 유효성 검사
            if (!idRegExp.test(document.getElementById("id").value)) {
                alert("아이디는 영문 대소문자와 숫자 4~12자리로 입력해야합니다!");
                return false;
            }

            if (document.getElementById("id").value == document.getElementById("pw").value) {
                alert("아이디와 비밀번호는 같을 수 없습니다!");
                return false;
            }


            if (document.member_form.pass.value != document.member_form.pass_confirm.value) {
                alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");
                document.member_form.pass.focus();
                document.member_form.pass.select();
                return false;
            }

        }

        function checkId() {
            alert("아이디 중복확인 기능 추가")
        }

        function checkNick() {
            alert("별명 중복확인 기능 추가")
        }
    </script>
</head>
<body>
<!--jumbotron 부분-->
<div class="container">
    <?php
    include "../lib/top_login_sub.php";
    include "../lib/top_menu_sub.php";
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
            <h2>회원가입</h2>
            <br><br>
            <form action="insert.php" method="post" name="member_form" onsubmit="return check_input()">
                <div class="form-group">
                    <label for="id">ID :</label>
                    <div class="form-check-inline">
                        <label class="form-check-label"><input type="text" class="form-control" id="id"
                                                               placeholder="Enter ID" name="id" size="70" readonly
                                                               required></label>
                        &nbsp;<label class="form-check-label">
                            <button type="button" class="btn btn-info" onclick="checkId()">중복확인</button>
                        </label>
                    </div>
                    <p id="idValid" style="color:red;font-size: 12px"></p>
                </div>
                <br>
                <div class="form-group">
                    <label for="pw">비밀번호 :</label>
                    <div class="form-check-inline">
                        <input type="password" class="form-control" id="pw" placeholder="비밀번호" name="pass" size="80" required>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="pw_confirm">비번확인 :</label>
                    <div class="form-check-inline">
                        <input type="password" class="form-control" id="pw_confirm" placeholder="비밀번호 재입력"
                               name="pass_confirm" size="80" required>
                    </div>
                </div>
                <br>
                <div class="form-group">

                    <label for="name">이름 :</label>
                    <div class="form-check-inline">
                        <label class="form-check-label"><input type="text" class="form-control" id="name"
                                                               placeholder="이름" name="name" size="85" required></label>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="nick">닉네임 :</label>
                    <div class="form-check-inline">
                        <label class="form-check-label"> <input type="text" class="form-control" id="nick"
                                                                placeholder="별명" name="nick" size="65"
                                                                required onblur="checkNick()"></label>
                    </div>
                    <p id="nickValid" style="color:red;font-size: 12px"></p>
                </div>
                <br>
                <div class="form-group">
                    <label for="phone">연락처 :</label>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <select class="form-control" id="sel1" name="hp1">
                                <option>통신사</option>
                                <option value="LGT">LGT</option>
                                <option value="KT">KT</option>
                                <option value="SKT">SKT</option>
                            </select>
                        </label> -
                        <label class="form-check-label">
                            <input type="text" class="form-control" name="hp2" placeholder="Center Number" maxlength="4"
                                   required>
                        </label> -
                        <label class="form-check-label">
                            <input type="text" class="form-control" name="hp3" placeholder="Last Number" maxlength="4"
                                   required>
                        </label>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="email">이메일 :</label>
                    <div class="form-check-inline">
                        <label class="form-check-label"> <input type="text" class="form-control" id="email"
                                                                placeholder="이메일" name="email" size="65"
                                                                required></label>
                    </div>
                    <p id="emailValid" style="color:red;font-size: 12px"></p>
                </div>
                 <br><br>
                <input type="submit" class="btn btn-primary" value="가입하기" />
                <input type="reset" class="btn btn-secondary" value="취소하기" />
            </form>
        </div>
    </div>
    <br><br>
</div>

</body>
</html>
