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
            <h2>로그인</h2>
            <br><br>
            <form name="member_form" method="post" action="login.php" class="form-group">
                <div class="form-group">
                    <label for="id">아이디 :</label>
                    <div class="form-check-inline">
                        <input type="text" class="form-control" id="id" placeholder="아이디" name="id"  size="77" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pw">비번확인 :</label>
                    <div class="form-check-inline">
                        <input type="password" class="form-control" id="pwm" placeholder="비밀번호"
                               name="pass" size="75" required>
                    </div>
                </div>
                <br>
                <div class="form-group" style="text-align: center">
                    <input type="submit" class="btn btn-primary" value="로그인" />
                </div>
            </form>
            <br><br>
            <hr />
            <p>아직 회원이 아니세요? <a href="member_form.php" class="btn btn-info">회원가입</a> </p>
        </div>
    </div>

    
</div>

</body>
</html>
