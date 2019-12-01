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

            .memobtn {
                width:100%;
            }


        }

        @media screen and (min-width: 1200px) {
            .memobtn {
                width:100%;
                height:160px;
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
    include_once ("memoDao.php");
    $dao = new memoDao();
    $numMsgs = $dao->selectMemo();
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
        <div class="col-sm-8 col-12 container">
            <br>
            <h2>메모장</h2>
            <br><br>
            <div><span><?php if($_SESSION["usernick"]){?>▷<?=$_SESSION["usernick"]?><?php } ?></span></div>
            <form name="memo_form" method="post" action="insert.php">
                <div class="row">
                    <div class="col-sm-10">
                       <textarea rows="6" class="form-control" name="content"></textarea>
                        <br>
                    </div>

                    <div class="col-sm-2 col-12">
                      <input type="submit" class="btn btn-info memobtn" value="메모하기" />
                    </div>

                </div>
                <br>
            </form>

                <?php foreach ($numMsgs as $row) : ?>
                  <div style="background: #D4F4FA;border-radius:5px">
                      <p  style="text-indent: 10px"><?=$row["num"]?>&nbsp;<?=$row["nick"]?>&nbsp;&nbsp;&nbsp;<?=$row["regist_day"]?>
                        &nbsp;<?php if($_SESSION["userid"]=="admin" || $_SESSION["userid"] == $row["id"]){?>
                            <a href="delete.php?num=<?=$row["num"]?>" class="btn btn-link" role="button">삭제</a>
                             <?php } ?></p>
                        <hr>
                        <p style="text-indent: 10px"><?=$row["content"]?></p>
                  </div>
                    <br><br>
                <?php endforeach; ?>

      </div>

    </div><!-- row end -->


</div>

</body>
</html>
