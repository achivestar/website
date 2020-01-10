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
    <link rel="stylesheet" href="../css/greet.css"/>
    <link rel="stylesheet" href="../css/common.css"/>
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
</head>
<body>
<!--jumbotron 부분-->
<div class="container">
    <?php
    include "../lib/top_menu_sub.php";
    include "../lib/top_login_sub.php";
?>

    <div class="row">
        <?php
        include_once "../lib/left_menu_sub.php";
        $seq = $_REQUEST["seq"];
        $detailUrl = "http://www.culture.go.kr/openapi/rest/publicperformancedisplays/d/?ServiceKey=su8PUzCodKId0bF%2BFq0Q2yLNfqt2YflX4hPXh%2F4ogLBahdqZtvoDs2F64%2BxiAwVFzXLDJd8tT2gmDgtXxMRAxg%3D%3D&id=1&seq=".$seq;
        $ch = curl_init();	
		cURL_setopt($ch, CURLOPT_URL,  $detailUrl);
		cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = cURL_exec($ch);
		cURL_close($ch); 	
		$load_string = simplexml_load_string($response);
		$obj_addr = $load_string->msgBody[0];
        ?>
        <div class="col-sm-8 col-12 container">
            <br>
            <h2>문화행사정보</h2>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    foreach ($obj_addr->perforInfo as $values) {
                    ?>
                        <p>제목 : <?=$values->title?></p>
                        <p>장르 : <?=$values->realmName?></p>
                        <p>장소 : <?=$values->placeAddr?></p>
                        <p>가격 : <?=$values->price?></p>
                        <p>기간 : <?=$values->startDate?>~<?=$values->endDate?></p>
                        <p>연락처 : <?=$values->phone?></p>
                        <p><a href="<?=$values->url?>"><img src="<?=$values->imgUrl?>" /></a></p>


                    <?php
                      }
                    ?>
                </div>
            </div>

        </div>
    </div>
    <?php
    include_once "../lib/footer.php";
    ?>
</div><!-- row end -->

</div> <!-- container -->


</body>
</html>
