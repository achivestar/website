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
    <link rel="stylesheet" href="../css/concert.css" />
    <link rel="stylesheet" href="../css/common.css" />
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script>

        $(document).ready(function(){
            $('#upfile1').on('change', function() {
                myfile= $(this).val();
                var ext = myfile.split('.').pop();
                if(ext!="gif" && ext!="png" && ext!="jpg" && ext!="jpeg"){
                  $(".error1").html("이미지파일만 업로드 가능합니다.");
                    $("#upfile1").val("");

                }else{
                    $(".error1").html("");
                }

            });
            $('#upfile2').on('change', function() {
                myfile= $(this).val();
                var ext = myfile.split('.').pop();
                if(ext!="gif" && ext!="png" && ext!="jpg" && ext!="jpeg"){
                    $(".error2").html("이미지파일만 업로드 가능합니다.");
                    $("#upfile2").val("");

                }else{
                    $(".error2").html("");
                }

            });
            $('#upfile3').on('change', function() {
                myfile= $(this).val();
                var ext = myfile.split('.').pop();
                if(ext!="gif" && ext!="png" && ext!="jpg" && ext!="jpeg"){
                    $(".error3").html("<span style='color:red'>이미지파일만 업로드 가능합니다.</span>");
                    $("#upfile3").val("");

                }else{
                    $(".error3").html("");
                }

            });

            $("#concertForm").on("submit",function(event){
                event.preventDefault();
                var count_error = 0;

                if($("#subject").val()==''){
                    $("#subject_error").text("Subject is required");
                    count_error++;
                }else{
                    $("#subject_error").text("");
                }

                if($("#content").val()==''){
                    $("#content_error").text("Content is required");
                    count_error++;
                }else{
                    $("#content_error").text("");
                }



                if(count_error==0){
                    $.ajax({
                        url : "process.php",
                        method : "post",
                        data : new FormData(this),
                        dataType : 'text',
                        contentType : false,
                        cache : false,
                        processData : false,
                        beforeSend : function(){
                            $("#save").attr("disabled","disabled");
                            $("#process").css("display","block");
                        },
                        success : function(){
                            var percentage = 0;
                            var timer = setInterval(function(){
                                percentage = percentage + 35;
                                progress_bar_process(percentage,timer);
                            },1000);

                        }
                    });
                }else{
                    return false;
                }
            });

            function progress_bar_process(percentage,timer){
                $(".progress-bar").css("width",percentage+"%");
                if(percentage>100){
                    clearInterval(timer);
                    $("#concertForm")[0].reset();
                    $("#process").css("display","none");
                    $(".progress-bar").css("width","0%");
                    $("#save").attr("disabled",false);
                    $("#success_message").html("<div class='alert alert-success'>등록되었습니다.</div>");

                    setTimeout(function(){
                        $("#success_message").html("");
                        location.href="./list.php";
                    },1500);

                }
            }

        });
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
        <?php
        include_once "../lib/left_menu_sub.php";
        ?>
        <div class="col-sm-8 col-12 container">
            <br>
            <h2>연주회 소개</h2>
            <div class="row">
                <div class="col-12 text-center"><h3>글쓰기</h3></div>
                <div class="col-sm-12">
                <form name="board_form" method="post" id="concertForm" enctype="multipart/form-data">
                    <div class="form-group">
                    <label for="nick">닉네임</label>&nbsp;
                        <input type="text" class="form-control" id="nick" value="<?=$_SESSION["usernick"]?>" readonly>
                    <div>
                    <br>
                    <div class="form-group">
                        <label for="subject">제목</label>
                        <input type="text" class="form-control" id="subject" name="subject">
                        <span id="subject_error" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="content">내용</label>&nbsp;
                        <textarea class="form-control" rows=10" id="content" name="content"></textarea>
                        <span id="content_error" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="upfile1">이미지파일1</label> <span class="error1"></span>
                        <input type="file" class="form-control-file" id="upfile1" name="upfile[]" accept=".gif, .jpg, .png, .jpeg">
                    </div><div class="form-group">
                            <label for="upfile2">이미지파일2</label>  <span class="error2"></span>
                            <input type="file" class="form-control-file" id="upfile2" name="upfile[]" accept=".gif, .jpg, .png, .jpeg">
                     </div>
                     <div class="form-group">
                            <label for="upfile3">이미지파일3</label>  <span class="error3"></span>
                            <input type="file" class="form-control-file" id="upfile3" name="upfile[]" accept=".gif, .jpg, .png, .jpeg">
                     </div>
                     <div class="form-group" id="process" style="display: none">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                     aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                     </div>
                     <div id="success_message"></div>
                        <input type="submit" name="save" id="save" class="btn btn-info" value="등록" />
                        <a href="./list.php" class="btn btn-info">목록</a>

                </form>
                </div>
            </div>
        </div>
    </div><!-- row end -->
</div> <!-- container -->
<?php
include_once "../lib/footer.php";
?>
</body>
</html>
