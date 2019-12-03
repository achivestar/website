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
    <script src="http://code.jquery.com/jquery-latest.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script>

        function add(){

            $.ajax({
                url : "./insert.php",
                type : "post",
                data : {"content" : $("#content").val()},
                dataType : "html",
                success : function (data) {
                  document.getElementById("valid").style.display="block";
                  $(".container").load('memo.php');
                }

            });
        }



    </script>
    <style>
        #valid{
            display: none;
        }
        @media screen and (max-width: 568px) {
            .lmenu {
                display: none
            }

            .memobtn {
                width: 100%;
            }


        }

        @media screen and (min-width: 1200px) {
            .memobtn {
                width: 100%;
                height: 160px;
            }

            .ripplebtn {
                width: 100%;
                height: 40px;
                vertical-align: middle;
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
    include_once("memoDao.php");
    define("NUM_LINES",5); //게시글 리스트의 줄 수
    define("NUM_PAGE_LINKS",5); // 화면에 표시될 페이지 링크의 수
    $dao = new memoDao();
    $numMsgs = $dao->selectMemo();

    //전달된 페이지 번호 저장
    $page = $_REQUEST["page"];
    //화면 구성에 관련된 상수 정의

    $numCount = $dao->getNumMsgs();
    if($numCount > 0){
        $numPages = ceil($numCount/NUM_LINES);
        // 현재 페이지 번호가 1~전체 페이지 수 를 벗어 나면 보정
        if($page<1)
            $page = 1;
        if($page > $numPages)
            $page = $numPages;
        //리스트에 보일 게시글의 데이터 읽기
        $start = ($page-1) * NUM_LINES; //첫 줄의 레코드 번호

        $msgs = $dao->getManyMsgs($start,NUM_LINES);
        //페이지네이션 컨트롤의 처음/ 마지막 페이지 링크 번호 계산
        $firstLink = floor(($page-1)/NUM_PAGE_LINKS) * NUM_PAGE_LINKS +1;
        $lastLink = $firstLink + NUM_PAGE_LINKS-1;
        if($lastLink>$numPages){
            $lastLink = $numPages;
        }
    }
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
             <div id="valid" class="alert alert-success"><strong >Success!! </strong></div>
            <?php if($numCount >0) : ?>
            <br><br>
            <div><span><?php if ($_SESSION["usernick"]) { ?>▷<?= $_SESSION["usernick"] ?><?php } ?></span></div>
            <form id="memo_form" class="form-group">
                <div class="row">
                    <div class="col-sm-10">
                        <textarea rows="6" class="form-control" id="content"  name="content"></textarea>
                        <br>
                    </div>

                    <div class="col-sm-2 col-12">
                        <input type="button" class="btn btn-info memobtn"  id="memoBtn" onclick="add()" value="메모하기"/>
                    </div>

                </div>
                <br>
            </form>

            <?php foreach ($msgs as $row) : ?>
                <div style="background: #D4F4FA;border-radius:5px">
                    <p style="text-indent: 10px"><?= $row["num"] ?>&nbsp;<?= $row["nick"] ?>
                        &nbsp;&nbsp;&nbsp;<?= $row["regist_day"] ?>
                        &nbsp;<?php if ($_SESSION["userid"] == "admin" || $_SESSION["userid"] == $row["id"]) { ?>
                            <a href="delete.php?num=<?= $row["num"] ?>" class="btn btn-link" role="button">삭제</a>
                        <?php } ?></p>
                    <hr>
                    <p style="text-indent: 10px"><?= $row["content"] ?></p>
                    <p>덧글</p>
                      <?php
                           $rippleRow = $dao->selectMemoRipple($row["num"]);
                           foreach ($rippleRow as $rows) :
                        ?>
                           <div>
                               <?= $rows["nick"]; ?>
                               <?= $rows["regist_day"]; ?>
                               <?php
                                    if($userid == "admin" || $_SESSION["userid"]==$rows["id"]){
                                        echo "<a href=delete_ripple.php?num=$rows[num]>삭제</a>";
                                    }

                               ?>
                                 <?= $rows["content"]; ?>
                           </div>
                     <?php endforeach; ?>
                       <script>
                           function rippleAdd<?=$row["num"]?>(){

                               $.ajax({
                                   url : "./insert_ripple.php",
                                   type : "post",
                                   data : {content:$("#ripple_content<?=$row["num"]?>").val(), num : $("#num<?=$row["num"]?>").val()},
                                   dataType : "html",
                                   success : function (data) {
                                       document.getElementById("valid").style.display="block";
                                       $(".container").load('memo.php');
                                   }

                               });
                           }

                       </script>
                    <form name="ripple_form" id="ripple_form" class="form-group">
                        <div class="row">
                            <div class="col-sm-10">
                                <input type="hidden" name="num" id="num<?=$row["num"]?>" value="<?= $row["num"] ?>"/>
                                <textarea rows="2" class="form-control" name="content" id="ripple_content<?=$row["num"]?>"></textarea>
                            </div>
                            <div class="col-sm-2 col-12">
                                <input type="button" class="btn btn-info ripplebtn" onclick="rippleAdd<?=$row["num"]?>()" value="덧글입력"/>
                            </div>
                        </div>
                    </form>
                </div>
                <br><br>
            <?php endforeach; ?>

            <div class="row justify-content-center align-items-center">
                <ul class="pagination">
                <?php if($firstLink>1) : ?>
                    <li class="page-item"><a href="./memo.php?page=<?=$page-NUM_PAGE_LINKS?>" class="page-link">Previous</a></li>
                <?php endif ?>
                <?php for($i = $firstLink; $i<=$lastLink; $i++) : ?>
                    <?php if($i==$page) : ?>
                    <li class="page-item"> <a href="./memo.php?page=<?=$i?>" class="page-link"><b><?=$i?></b></a></li>
                    <?php else : ?>
                    <li class="page-item"> <a href="./memo.php?page=<?=$i?>" class="page-link"><?=$i?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>
                <?php if($lastLink < $numPages) : ?>
                    <li class="page-item"> <a href="./memo.php?page=<?=$page+NUM_PAGE_LINKS?>" class="page-link">Next</a></li>
                <?php endif ?>
                </ul>
            </div>
            <?php endif ?>
        </div>

    </div><!-- row end -->



</div>

</body>
</html>
