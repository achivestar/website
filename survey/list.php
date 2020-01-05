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
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        $(document).ready(function() {
            $('#survey').submit(function (event) {
                event.preventDefault();
                if(!$('[type=radio]:checked').val()){
                    alert("항목을 선택하세요.");
                }
                if($('[type=radio]:checked').val()){
                    $.ajax({
                        url: "./update.php",
                        type: "post",
                        data: {
                            "composer": $('[type=radio]:checked').val(),
                            "id" : $("#id").val()
                        },
                        dataType: "html",
                        success: function (data) {
                           // alert(data);
                            //$("#tbody").html(data);
                            alert("투표에 참여하여 주셔서 감사합니다");
                            location.reload();
                        }
                    });
                }else{
                    location.reload();
                }
            });
        });

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

    include_once("surveyDao.php");

    $dao = new surveyDao();
    $total_count = $dao->countSurvey();
    $msgs = $dao->selectSurvey();
    ?>

    <div class="row">
        <?php
        include_once "../lib/left_menu_sub.php";
        ?>
        <div class="col-sm-8 col-12">
            <br>
            <h2>설문조사</h2>
                <div class="col-sm-6">총 <?=$total_count?> 개의 설문이 있습니다.</div>
                <div class="row">
                    <?php foreach ($msgs as $row) : ?>

                       <div class="col-sm-4 text-left" style="margin-top:40px;">
                           <h6><?=$row["subject"]?></h6>
                        <form id="survey">
                            <input type="hidden" name="id" id="id" value="<?=$row['id']?>" />
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input ans1" name="composer" id="point_0" value="point_0">
                                <label class="custom-control-label" for="point_0"><?=$row["class_name_0"]?></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input ans2" name="composer" id="point_1"  value="point_1">
                                <label class="custom-control-label" for="point_1"><?=$row["class_name_1"]?></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input ans3"  name="composer" id="point_2"  value="point_2">
                                <label class="custom-control-label" for="point_2"><?=$row["class_name_2"]?></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input ans4"  name="composer" id="point_3"  value="point_3">
                                <label class="custom-control-label" for="point_3"><?=$row["class_name_3"]?></label>
                            </div>
                            <button type="submit" class="btn btn-primary">투표하기</button>
                        </form>
                    </div>
                    <?php endforeach; ?>
                    <div class="col-sm-8">
                        <div id="columnchart" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
         </div>

    </div><!-- row end -->
</div> <!-- container -->


    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([

                ['class Name','singer'],
                <?php
                foreach ($msgs as $row) :
                    $subject = $row["subject"];
                    echo "['".$row['class_name_0']."',".$row['point_0']."],";
                    echo "['".$row['class_name_1']."',".$row['point_1']."],";
                    echo "['".$row['class_name_2']."',".$row['point_2']."],";
                    echo "['".$row['class_name_3']."',".$row['point_3']."],";

                endforeach;
                ?>

            ]);

            var options = {
                title: '<?=$subject?>',
                pieHole: 0.5,
                pieSliceTextStyle: {
                    color: 'black',
                },
                legend: ''
            };
            var chart = new google.visualization.PieChart(document.getElementById("columnchart"));
            chart.draw(data,options);
        }

    </script>

</body>
</html>
