<?php
    session_start();
 ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bluering  연주회</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>

<div class="container">
    <?php
    include "./lib/top_menu1.php";
    include "./lib/top_login1.php";
    include "./lib/func.php";


    $url = "http://www.culture.go.kr/openapi/rest/publicperformancedisplays/period?ServiceKey=su8PUzCodKId0bF%2BFq0Q2yLNfqt2YflX4hPXh%2F4ogLBahdqZtvoDs2F64%2BxiAwVFzXLDJd8tT2gmDgtXxMRAxg%3D%3D&id=1";
    //기간 &from=20190101&to=20191231
    $data = file_get_contents($url);
    $xml = simplexml_load_string($data);
    $obj_addr = $xml->msgBody[0];
    ?>

    <div class="row" id="latest_article">
        <div class="col-sm-4">
            <h4>연주회소개<span style="float: right;font-size:14px"><a href="concert/list.php">More</a></span></h4>
            <?= latest_article("concert",5,30);?>
        </div>
        <div class="col-sm-4">
            <h4>자유게시판<span style="float: right;font-size:14px"><a href="free/list.php">More</a></span></h4>
            <?= latest_article("free",5,30);?>
        </div>
        <div class="col-sm-4">
            <h4>공연정보<span style="float: right;font-size:14px"><a href="culture/list.php">More</a></span></h4>
            <ul id="ticker" class="ticker">
                <?php
                foreach ($obj_addr->perforList as $values) {
                ?>
                <li><a href="./culture/detail.php?seq=<?=$values->seq?>"><?= $values->title ?></a></li>
               <?php
                }
                ?>

            </ul>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h4>갤러리<span style="float: right;font-size:14px"><a href="gallery/list.php">More</a></span></h4>
                <?= latest_gallery("gallery",30);?>
            </div>
            <div class="col-sm-6">
                <h4>설문조사<span style="float: right;font-size:14px"><a href="survey/list.php">More</a></span></h4>
                <?= survey_article();?>
            </div>
        </div>



    </div>

    <?php
        include "./lib/footer.php";
    ?>
    <script>
        function tick(){
            $('#ticker li:first').slideUp( function () { $(this).appendTo($('#ticker')).slideDown(); });
        }
        setInterval(function(){ tick () }, 3000);

    </script>
</div>


</html>
