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
    <link rel="stylesheet" href="../css/common.css"/>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script>
        function moreComment(id, parent) {
           //  alert(id+","+parent);
            var session_id = "<?=$_SESSION['userid']?>";

            if (id) {
               $(".more").html('<img src="../img/loading.gif" style="width:100px;height:100px"/>');
                $.ajax({
                    type: "POST",
                    url: "ajax_more.php",
                    data: {lastmsg: id, session_id: session_id, parent: parent},
                    cache: false,
                    success: function (data) {
                        $("#more").remove(); // removing old more button
                        $("#comments").append(data);
                    }
                });  //end ajax
            } else {
                $("#more").remove();
            }

            return false;
        }


        function rippleAdd(num, ripple_content) {

            $.ajax({
                url: "./insert_ripple.php",
                type: "post",
                data: {content: ripple_content, num: num},
                dataType: "html",
                success: function (data) {
                    location.reload();
                }

            });
        }

        function rippleAddNot() {

            alert("로그인이 필요한 서비스 입니다.");
            location.href = "../login/login_form.php?login=free";

        }

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

        function rippleDel(parent,num){
           // alert(parent+","+num);
            var ans = window.confirm("댓글을 삭제하시겠습니까?");
            if(ans==true){
                $.ajax({
                    url: "./rippleDelete.php",
                    type: "post",
                    data: {"parent":parent , "num":num},
                    dataType: "html",
                    success: function (data) {
                        $("#valid").show();
                        window.setTimeout(function () {
                            $("#valid").hide();
                            location.href="./view.php?num="+parent;
                        }, 1000);

                    }

                });
            }else{
                return;
            }

        }
    </script>
</head>
<body>
<!--jumbotron 부분-->
<div class="container">
    <?php
    include "../lib/top_menu_sub.php";
    include "../lib/top_login_sub.php";

    include_once("freeDao.php");
    $page = $_REQUEST["page"];
    $dao = new freeDao();
    $num = $_REQUEST["num"];

    $row = $dao->viewFree($num);
    $msgs = $dao->selectFreeRipple($num);
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
            <h2>자유게시판</h2>
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
                    <p style="height: 5em;"><?=$content?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?php foreach ($msgs as $rows) :
                        $msg_id = $rows["num"];

                        ?>

                            <div class="rippleContent">
                                    <p>└ <span class="nick" style='color:dodgerblue'><?= $rows["nick"]; ?></span>
                                        <span style='color:slategray'><?= $rows["regist_day"]; ?></span>
                                        <?php if($_SESSION["userid"]) {?>
                                        <span style="float: right">
                                            <a href="#" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#rippleDel"
                                              onclick="rippleDel('<?=$row['num']?>','<?=$msg_id?>')">삭제</a></span>
                                        <?php } ?>
                                    </p>
                                    <p style='text-indent: 20px'><?= $rows["content"]; ?></p>
                            </div>

                    <?php endforeach; ?>
                    <div id="comments"></div>
                    <?php
                    $rippleNum = $dao->getNumRippleMsgs($num);
                       if ($rippleNum>3) :
                    ?>
                        <div id="more" class="morebox">
                            <a href="#none" class="more btn btn-info btn-block" role="button"
                               onclick="moreComment('<?=$msg_id?>','<?=$num?>')">more</a>
                        </div>
                    <?php
                    endif;
                    ?>
                    <br><br>
                    <form name="ripple_form" id="ripple_form" class="form-group">
                        <div class="row">
                            <div class="col-sm-10">
                                <input type="hidden" name="num" id="num<?=$num?>" />
                                <textarea rows="2" class="form-control" name="content_ripple"
                                          id="ripple_content<?=$num?>"></textarea>
                            </div>

                            <div class="col-sm-2 col-12">
                                <?php
                                if ($_SESSION["userid"]) {
                                    ?>
                                    <input type="button" class="btn btn-info ripplebtn"
                                           onclick="rippleAdd(<?=$num?>,content_ripple.value)"
                                           value="덧글입력"/>
                                    <?php
                                } else {
                                    ?>
                                    <input type="button" class="btn btn-info ripplebtn" onclick="rippleAddNot()"
                                           value="덧글입력"/>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </form>

                </div>

            </div>

            <br><br>
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
    <?php
    include_once "../lib/footer.php";
    ?>
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
