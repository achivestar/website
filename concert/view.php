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
    <link rel="stylesheet" href="../css/concert.css"/>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script>
        function del(num){
            $.ajax({
                url: "./delete.php",
                type: "post",
                data: {"num" : num},
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
    </script>
    <style>
        table th{
            text-align: center;
        }
        table td {
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>
<body>
<!--jumbotron 부분-->
<div class="container">
    <?php
    include "../lib/top_menu_sub.php";
    include "../lib/top_login_sub.php";

    include_once("concertDao.php");
    $page = $_REQUEST["page"];
    $dao = new concertDao();
    $num = $_REQUEST["num"];

    $row = $dao->viewConcert($num);
    if($_SESSION["userid"]!=$row["id"]){
        $dao->increaseHit($num);
    }
    $subject = str_replace("","&nbsp;",$row["subject"]);
    $regist_day = $row["regist_day"];
    $regist_day = substr($regist_day,0,10);
    if($row["is_html"] != "y"){
        $content = str_replace(" ","&nbsp;",$row["content"]);
        $content = str_replace("\n","<br>",$row["content"]);
    }
    $image_copied[0] = $row["file_copied_0"];
    $image_copied[1] = $row["file_copied_1"];
    $image_copied[2] = $row["file_copied_2"];
    ?>

    <div class="row">
        <?php
        include_once "../lib/left_menu_sub.php";
        ?>
        <div class="col-sm-8 col-12 container">
                <br>
                <h2>가입인사</h2>
                <div class="row">
                    <div class="alert alert-danger col-sm-12" id="valid" style="display: none">
                        <strong>삭제 되었습니다.</strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;margin-bottom:20px;
                            background-color:#e6e6ff;height:50px;line-height:50px">
                        <p style="float: left"><?=$subject?></p>
                        <p  style="float: right"><?=$row["nick"]?> | 조회:<?=$row["hit"]?> | <?=$regist_day?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p>
                        <?php
                        for($i=0; $i<3; $i++){
                                if($image_copied[$i]){
                                    echo "<img src=./uploads/".$image_copied[$i]." style=;width:500px;height:400px'>";
                                }
                            }
                        ?>
                        </p>
                       <p style="height: 18em;"><?=$content?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-right">
                        <a href="list.php" class="btn btn-info">목록</a>
                        <?php if($_SESSION["userid"] || $row["id"]=="admin" || $row["level"]==1){ ?>
                        <a href="update_form.php?num=<?=$row['num']?>&page=<?=$page?>" class="btn btn-info">수정</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                                삭제
                            </button>
                        <?php } ?>
                        <a href="write_form.php" class="btn btn-success">글쓰기</a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- row end -->
</div> <!-- container -->
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">글삭제</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
               정말 삭제하시겠습니까?
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="del('<?=$row['num']?>')">삭제</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
            </div>

        </div>
    </div>
</div>
</body>
</html>
