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
    <script src="https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>

    <style>
        table th{
            text-align: center;
        }
        table td {
            font-size: 12px;
            text-align: center;
        }

        @media screen and (max-width: 568px) {
            .lmenu {
                display: none
            }

            .griditem{
                list-style: none;
                width:100%;
                height: 300px;
                border:1px solid red;
                margin-bottom: 40px;
            }

        }

        @media screen and (min-width: 569px) {
            .griditem{
                list-style: none;
                width:310px;
                height: 300px;
                border:1px solid #222;
                margin-bottom: 40px;
            }

        }

        .grid{
            width:100%;
            max-width: 100%;
            text-align: center;
            display: flex;
        }
        img{
            width:100%;
            display: inline-block;
            height: 100%;
        }
        .griditem{
            list-style: none;
            width:210px;
            margin-bottom: 40px
        }

        .grid ul{
            width:100%;
        }

        .griditem.gt2{
            height: 300px;
        }
        .griditem.gt3{
            height: 200px;
        }
        .griditem.gt4{
            height: 280px;
        }

    </style>
</head>
<body>
<!--jumbotron 부분-->
<div class="container">
    <?php
    include "../lib/top_menu_sub.php";
    include "../lib/top_login_sub.php";

    include_once("galleryDao.php");
    $dao = new galleryDao();
    $total_count = $dao->countGallery();
    $msgs = $dao->selectGallery();

    ?>

    <div class="row">
        <?php
        include_once "../lib/left_menu_sub.php";
        ?>
        <div class="col-sm-8 col-12 container">
            <br>
            <h2>갤러리</h2>
            <div class="row"  id="tbody">
                <div class="col-sm-6">총 <?=$total_count?> 개의 게시물이 있습니다.</div>
                <div class="col-sm-12 grid" id="comment">
                        <ul>
                            <?php
                            //$num = $total_count;
                            $rippleNum = $dao->selectGallery();
                                foreach ($rippleNum as $row) :
                                    $num = $row["num"];

                            ?>
                                   <li class="griditem gt2"><img src="./uploads/<?= $row['file_copied_0'] ?>"/><?=$num?></li>
                                   <li class="griditem gt4"><img src="./uploads/<?= $row['file_copied_1'] ?>"/><?=$num?></li>
                                   <li class="griditem gt3"><img src="./uploads/<?= $row['file_copied_2'] ?>"/><?=$num?></li>
                             <?php
                                endforeach;
                                 ?>

                        </ul>

                </div>
    <!--                <div id="comment2" class="col-sm-12 grid"></div>-->


                <div class="col-sm-12 text-right">
                    <a href="write_form.php" class="btn btn-info">글쓰기</a>
                </div>
            </div>
           
        </div>
    </div><!-- row end -->
</div> <!-- container -->
<script>
    function moreComment(num){
        setTimeout(function () {
            getMoreArticle(num);
        }, 500);
    }
    function getMoreArticle(num){
        alert(num);
        if(num){
            $.ajax({
                type: "POST",
                url: "ajax_more.php",
                data: {id: num},
                cache: false,
                success: function(data){
                    // alert(data);
                    var $altems = data;
                    //alert($altems);
                    /* setTimeout(function(){
                         $grid.append($altems).masonry("appended",$altems,true);
                     },500);*/
                   // $("#more").remove();
                    $("#comment2").append(data);

                }
            });  //end ajax
        }else{
            $("#more").remove();
        }

    }
    $(document).ready(function() {
      /*  $(window).scroll(function () {
            if(<?=$num?>>=0) {
                if ($(window).scrollTop() == ($(document).height() - $(window).height())) {
                    setTimeout(function () {
                        getMoreArticle(<?=$num?>);
                    }, 500);
                }
            }
        });*/


        var $container = $("#comment");
        $container.masonry({
            itemSelector : '.griditem',
            //columnWidth:210,
            gutter:30,
            horizontalOrder : true,
            transitionDuration : '0.2s'
        });

    });


</script>
</body>
</html>
                                                                                                                                                            