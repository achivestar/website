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
    <link rel="stylesheet" href="../css/greet.css"/>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script>
        function modify(num) {
            if($("#content").val()==""){
                $(".content").show();
            }else{
                $(".content").hide();
            }
            if($("#subject").val()==""){
                $(".subject").show();
            }else{
                $(".subject").hide();
            }
            if($("#content").val()!="" && $("#subject").val()!=""){
                $(".content").hide();
                $(".subject").hide();
                $.ajax({
                    url: "./modify.php",
                    type: "post",
                    data: {"content": $("#content").val(), "subject": $("#subject").val(), "num" : num},
                    dataType: "html",
                    success: function (data) {
                        $("#valid").show();
                        window.setTimeout(function () {
                            $("#valid").hide();
                            location.href="./list.php";
                        }, 2000);

                    }

                });
            }

        }
    </script>
    <style>
        .subject{
            font-size: 11px;
            display: none;
        }
        .content{
            font-size: 11px;
            display: none;
        }
    </style>
</head>
<body>
<!--jumbotron 부분-->
<div class="container">
    <?php
    include "../lib/top_menu_sub.php";
    include "../lib/top_login_sub.php";

    include_once("greetDao.php");
    $dao = new greetDao();
    $num = $_REQUEST["num"];
    $page = $_REQUEST["page"];
    $row = $dao->viewGreet($num);
    ?>

    <div class="row">
        <?php
        include_once "../lib/left_menu_sub.php";
        ?>
        <div class="col-sm-8 col-12 container">
            <br>
            <h2>가입인사</h2>
            <div class="row">
                <div class="col-12 text-center"><h3>글쓰기</h3></div>
                <div class="col-sm-12">
                    <form name="board_form">
                        <div class="form-group">
                            <label for="nick">닉네임</label>&nbsp;
                            <input type="text" class="form-control" id="nick" value="<?=$_SESSION["usernick"]?>" readonly>
                            &nbsp;
                            <div>
                                <br>
                                <div class="form-group">
                                    <label for="subject">제목</label>&nbsp;<span class="badge badge-warning subject">제목을 입력하세요</span>
                                    <input type="text" class="form-control" id="subject" name="subject" value="<?=$row['subject']?>">
                                </div>
                                <div class="form-group">
                                    <label for="content">내용</label>&nbsp;<span class="badge badge-warning content">내용을 입력하세요</span>
                                    <textarea class="form-control" rows=10" id="content" name="content"><?=$row["content"]?></textarea>
                                </div>
                                <div class="form-group text-right">
                                    <div class="alert alert-success" id="valid" style="display: none">
                                        <strong>수정 되었습니다.</strong>
                                    </div>
                                    <button type="button" class="btn btn-primary" onclick="modify('<?=$row['num']?>')">수정</button>
                                    <a href="./list.php" class="btn btn-info">목록</a>
                                </div>
                    </form>
                </div>
            </div>
            </div>
            
        </div>
    </div><!-- row end -->
</div> <!-- container -->

</body>
</html>
