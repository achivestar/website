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
    <link rel="stylesheet" href="../css/memo.css" />
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="../js/memo.js"></script>
    <script>

        function moreComment(id, parent) {
            // alert(id+","+parent);
            var session_id = "<?=$_SESSION['userid']?>";

            if (id) {
                $("#more" + id).html('<img src="loading.gif" style="width:10px;height:10px"/>');
                $.ajax({
                    type: "POST",
                    url: "ajax_more.php",
                    data: {lastmsg: id, session_id: session_id, parent: parent},
                    cache: false,
                    success: function (html) {
                        $("#comments" + parent).append(html);
                        $("#more" + parent).remove(); // removing old more button
                    }
                });  //end ajax
            } else {
                $("#more" + parent).html("");
            }

            return false;
        }
    </script>
</head>
<body>
<!--jumbotron 부분-->
<div class="container">
    <?php
    include "../lib/top_menu_sub.php";
    include "../lib/top_login_sub.php";

    include_once("memoDao.php");

    $dao = new memoDao();
    $msgs = $dao->selectMemo();
    include_once ("./paging.php");

    ?>

    <div class="row">
        <?php
            include_once "../lib/left_menu_sub.php";
        ?>
        <div class="col-sm-8 col-12 container">
            <br>
            <h2>메모장</h2>
            <div id="valid" class="alert alert-success"><strong>Success!! </strong></div>

                <br><br>
                <div><span><?php if ($_SESSION["usernick"]) { ?>▷<?= $_SESSION["usernick"] ?><?php } ?></span></div>
                <form id="memo_form" class="form-group">
                    <div class="row">
                        <div class="col-sm-10">
                            <textarea rows="6" class="form-control" id="content" name="content"></textarea>
                            <br>
                        </div>

                        <div class="col-sm-2 col-12">
                            <?php
                            if ($_SESSION["userid"]) {
                                ?>
                                <input type="button" class="btn btn-info memobtn" id="memoBtn" onclick="add()"
                                       value="메모하기"/>
                                <?php
                            } else {
                                ?>
                                <input type="button" class="btn btn-info memobtn" id="memoBtn" onclick="add_not()"
                                       value="메모하기"/>
                                <?php
                            }
                            ?>
                        </div>

                    </div>
                    <br>
                </form>

                <?php foreach ($msgs as $row) : ?>
                    <div class="memoContent">
                        <p>&nbsp<?= $row["nick"] ?>
                            &nbsp;&nbsp;&nbsp;<?= $row["regist_day"] ?>
                            &nbsp;<?php if ($_SESSION["userid"] == "admin" || $_SESSION["userid"] == $row["id"]) { ?>
                                <a href="#none" class="btn btn-link" role="button"
                                   onclick="del_memo(<?= $row["num"] ?>)">삭제</a>
                            <?php } ?></p>
                        <hr>
                        <p><?= $row["content"] ?></p>
                        <div class="rippleContent" id="comments<?=$row['num']?>">

                        <?php
                        //echo $row["num"];
                        $rippleRow = $dao->selectMemoRipple($row["num"]);
                        foreach ($rippleRow as $rows) :
                            $msg_id = $rows["num"];
                            $parent_id = $rows["parent"];
                            ?>

                                <p>└ <span class="nick"><?= $rows["nick"]; ?></span>
                                     <span class="day"><?= $rows["regist_day"]; ?></span>
                                    <?php
                                    if ($userid == "admin" || $_SESSION["userid"] == $rows["id"]) {
                                        echo "<a href='#none' onclick='del_memo_ripple($msg_id)' class=\"btn btn-link\">삭제</a>";
                                    }

                                    ?>
                                </p>

                                <p><?= $rows["content"]; ?></p>


                        <?php endforeach; ?>
                            <?php
                                $rippleNum = $dao->getNumRippleMsgs($parent_id);
                                if ($rippleNum >3) :
                            ?>
                            <div id="more<?=$parent_id ?>" class="morebox<?=$parent_id?>">
                                <a href="#none" class="more<?=$parent_id?> btn btn-info btn-block" role="button"
                                 onclick="moreComment('<?=$msg_id?>','<?=$parent_id?>')">more</a>
                            </div>
                            <?php
                                endif;
                            ?>
                        </div>
                        <hr>
                        <form name="ripple_form" id="ripple_form" class="form-group">
                            <div class="row">
                                <div class="col-sm-10">
                                    <input type="hidden" name="num" id="num<?= $row["num"] ?>"
                                           value="<?= $row["num"] ?>"/>
                                    <textarea rows="2" class="form-control" name="content_ripple"
                                              id="ripple_content<?= $row["num"] ?>"></textarea>
                                </div>
                                <div class="col-sm-2 col-12">
                                    <?php
                                    if ($_SESSION["userid"]) {
                                        ?>
                                        <input type="button" class="btn btn-info ripplebtn"
                                               onclick="rippleAdd(<?= $row["num"] ?>,content_ripple.value)"
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
                    <br><br>
                <?php endforeach; ?>

                <div class="row justify-content-center align-items-center">
                    <ul class="pagination">
                        <?php if ($firstLink > 1) : ?>
                            <li class="page-item"><a href="./memo.php?page=<?= $page - NUM_PAGE_LINKS ?>"
                                                     class="page-link">Previous</a></li>
                        <?php endif ?>
                        <?php for ($i = $firstLink; $i <= $lastLink; $i++) : ?>
                            <?php if ($i == $page) : ?>
                                <li class="page-item"><a href="./memo.php?page=<?= $i ?>"
                                                         class="page-link"><b><?= $i ?></b></a></li>
                            <?php else : ?>
                                <li class="page-item"><a href="./memo.php?page=<?= $i ?>"
                                                         class="page-link"><?= $i ?></a></li>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <?php if ($lastLink < $numPages) : ?>
                            <li class="page-item"><a href="./memo.php?page=<?= $page + NUM_PAGE_LINKS ?>"
                                                     class="page-link">Next</a></li>
                        <?php endif ?>
                    </ul>
                </div>

        </div>

    </div><!-- row end -->


</div>

</body>
</html>
