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
        $(document).ready(function() {
            $('#concert_board').submit(function (event) {
                event.preventDefault();
                if($("#search").val()!="" ){
                    $.ajax({
                        url: "./search.php?mode=search",
                        type: "post",
                        data: {"search": $("#search").val()},
                        dataType: "html",
                        success: function (data) {
                            //alert(data);
                            $("#tbody").html(data);
                        }
                    });
                }else{
                    location.reload();
                }
            });
        });

    </script>
</head>
<body>
<!--jumbotron 부분-->
<div class="container">
    <?php
    include "../lib/top_menu_sub.php";
    include "../lib/top_login_sub.php";

    include_once("downloadDao.php");
    $dao = new downloadDao();
    $total_count = $dao->countDownload();
    $msgs = $dao->selectDownload();
    include_once ("./paging.php");
    ?>

    <div class="row">
        <?php
        include_once "../lib/left_menu_sub.php";
        ?>
        <div class="col-sm-8 col-12 container">
            <br>
            <h2>자료실</h2>
            <div class="row"  id="tbody">
                <div class="col-sm-6">총 <?=$total_count?> 개의 게시물이 있습니다.</div>
                <div class="col-sm-6" style="margin-bottom: 10px">
                    <form id="concert_board">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" id="search" name="search">
                            <div class="input-group-append">
                                <input class="btn btn-success" type="submit" value="Go"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>번호</th>
                            <th>제목</th>
                            <th>글쓴이</th>
                            <th>등록일</th>
                            <th>조회</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($msgs as $row) :
                            $regist_day = explode(" ",$row["regist_day"]);
                            if(strlen($row["subject"])>=30){
                                $subject = substr($row['subject'],0,30);
                                $subject.="...";
                            }else{
                                $subject = $row["subject"];
                            }
                            ?>

                            <tr>
                                <td><?=$row["num"]?></td>
                                <td><a href="view.php?num=<?=$row["num"]?>"><?=$subject?></a></td>
                                <td><?=$row["nick"]?></td>
                                <td><?=$regist_day[0]?></td>
                                <td><?=$row["hit"]?></td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-12 text-right">
                    <a href="write_form.php" class="btn btn-info">글쓰기</a>
                </div>
            </div>
            <?php if(isset($page)){?>
                <div class="col-sm-12 row justify-content-center align-items-center">
                    <ul class="pagination">
                        <?php if ($firstLink > 1) : ?>
                            <li class="page-item"><a href="./memo.php?page=<?= $page - NUM_PAGE_LINKS ?>"
                                                     class="page-link">Previous</a></li>
                        <?php endif ?>
                        <?php for ($i = $firstLink; $i <= $lastLink; $i++) : ?>
                            <?php if ($i == $page) : ?>
                                <li class="page-item"><a href="./list.php?page=<?= $i ?>"
                                                         class="page-link"><b><?= $i ?></b></a></li>
                            <?php else : ?>
                                <li class="page-item"><a href="./list.php?page=<?= $i ?>"
                                                         class="page-link"><?= $i ?></a></li>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <?php if ($lastLink < $numPages) : ?>
                            <li class="page-item"><a href="./list.php?page=<?= $page + NUM_PAGE_LINKS ?>"
                                                     class="page-link">Next</a></li>
                        <?php endif ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div><!-- row end -->
    <?php
        include_once "../lib/footer.php";
    ?>
</div> <!-- container -->

</body>
</html>
