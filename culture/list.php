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
        ?>
        <div class="col-sm-8 col-12 container">
            <br>

            <div class="row" id="tbody">
                <div class="col-sm-6"><h2>문화행사정보</h2></div>
                <div class="col-sm-6" style="margin-bottom: 10px">
                    <form id="greet_board">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" id="search" name="search">
                            <div class="input-group-append">
                                <input class="btn btn-success" type="submit" value="Go"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12">

                    <?php

                    $url = "http://www.culture.go.kr/openapi/rest/publicperformancedisplays/period?ServiceKey=su8PUzCodKId0bF%2BFq0Q2yLNfqt2YflX4hPXh%2F4ogLBahdqZtvoDs2F64%2BxiAwVFzXLDJd8tT2gmDgtXxMRAxg%3D%3D&id=1";
                
                    $ch = curl_init();	
					cURL_setopt($ch, CURLOPT_URL, $url);
					cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$response = cURL_exec($ch);
					cURL_close($ch); 	
					$load_string = simplexml_load_string($response);
					$obj_addr = $load_string->msgBody[0];
                    ?>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>제작사</th>
                            <th>제목</th>
                            <th>장르</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($obj_addr->perforList as $values) {
                            ?>
                            <tr>

                                <td><?= $values->place ?></td>
                                <td><a href="./detail.php?seq=<?=$values->seq?>"><?= $values->title ?></a></td>
                                <td><?= $values->realmName ?></td>
                            </tr>
                            <?php
                                 }
                              ?>
                        </tbody>
                    </table>
                    <p class="text-right">데이터제공 : 한국문화정보원</p>
                </div>


            </div>

        </div>
    </div><!-- row end -->
    <?php
    include_once "../lib/footer.php";
    ?>
</div> <!-- container -->

</body>
</html>
