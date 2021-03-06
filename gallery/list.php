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
    <link rel="stylesheet" href="../css/common.css" />
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>

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
                                   <li class="griditem"><img src="./uploads/<?= $row['file_copied_0'] ?>"/><?=$row["subject"]?></li>
                             <?php
                                endforeach;
                                 ?>

                        </ul>

                </div>
    <!--                <div id="comment2" class="col-sm-12 grid"></div>-->


                <div class="col-sm-12 text-right">
                    <?php
                    if ($_SESSION["userid"]=="admin") {
                        ?>
                        <a href="write_form.php" class="btn btn-info">글쓰기</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
           
        </div>
    </div><!-- row end -->
    <?php
    include_once "../lib/footer.php";
    ?>
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
            gutter:10,
            horizontalOrder : true,
            transitionDuration : '0.2s'
        });

    });


</script>
</body>
</html>
                                                                                                                                                            