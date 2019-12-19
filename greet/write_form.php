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
    <link rel="stylesheet" href="../css/greet.css" />
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script>
        function add() {
           var is_checked =  $("#html_ok").is(":checked");
           var checked = null;
           if(is_checked === true){
                 checked = "y";

           }else{
                 checked = "";
           }

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
                   url: "./insert.php",
                   type: "post",
                   data: {"content": $("#content").val(), "subject": $("#subject").val(), "html_ok" : checked },
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
     function addNot(){
         alert("로그인이 필요한 서비스 입니다.");
         location.href = "../login/login_form.php?login=greet";
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
    include "../lib/top_login_sub.php";
    include "../lib/top_menu_sub.php";


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
                    <input type="hidden" name="mode" value="insert" />
                    <div class="form-group">
                    <label for="nick">닉네임</label>&nbsp;
                        <input type="text" class="form-control" id="nick" value="<?=$_SESSION["usernick"]?>" readonly>
                        &nbsp;
                        <div class="form-group custom-control custom-checkbox mb-3" >
                            <input type="checkbox" class="custom-control-input" id="html_ok" name="html_ok">
                            <label class="custom-control-label" for="html_ok">HTML글쓰기</label>
                        </div>
                    <div>
                    <br>
                    <div class="form-group">
                        <label for="subject">제목</label>&nbsp;<span class="badge badge-warning subject">제목을 입력하세요</span>
                        <input type="text" class="form-control" id="subject" name="subject">
                    </div>
                    <div class="form-group">
                        <label for="content">내용</label>&nbsp;<span class="badge badge-warning content">내용을 입력하세요</span>
                        <textarea class="form-control" rows=10" id="content" name="content"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <div class="alert alert-success" id="valid" style="display: none">
                            <strong>등록 되었습니다.</strong>
                        </div>
                        <?php
                        if ($_SESSION["userid"]) {
                        ?>
                        <button type="button" class="btn btn-primary" onclick="add()">완료</button>
                        <?php
                            } else {
                        ?>
                        <button type="button" class="btn btn-primary" onclick="addNot()">완료</button>
                        <?php
                         }
                        ?>
                        <a href="./list.php" class="btn btn-info">목록</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div><!-- row end -->
</div> <!-- container -->

</body>
</html>
