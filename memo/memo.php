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
                <a href="./memo.php" class="list-group-item list-group-item-action">낙서장</a>
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
            <h2>메모장</h2>
            <br><br>
            <form name="memo_form" method="post" action="insert.php">
                <span>▷<?=$_SESSION["usernick"]?></span>
                <textarea rows="6" cols="95" name="content"></textarea>
                <input type="submit" value="메모하기" />
            </form>
        </div>
    </div>


</div>

</body>
</html>
