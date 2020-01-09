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
    <link rel="stylesheet" href="../css/concert.css" />
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<!--jumbotron 부분-->
<div class="container">
    <?php
    include "../lib/top_login_sub.php";
    include "../lib/top_menu_sub.php";


    ?>

    <div class="row">
        <?php
        include_once "../lib/left_menu_sub.php";
        ?>
        <div class="col-sm-8 col-12 container">
            <br>
            <h2>설문조사</h2>
            <div class="row">
                <div class="col-12 text-center"><h3>글쓰기</h3></div>
                <div class="col-sm-12">
                    <form name="board_form" method="post" action="save.php">
                        <div class="form-group">
                            <div>
                                <br>
                                <div class="form-group">
                                    <label for="subject">제목</label>
                                    <input type="text" class="form-control" id="subject" name="subject">
                                    <span id="subject_error" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Item1</label>
                                    <input type="text" class="form-control" name="class_name_0">
                                    <label>Item2</label>
                                    <input type="text" class="form-control" name="class_name_1">
                                    <label>Item3</label>
                                    <input type="text" class="form-control" name="class_name_2">
                                    <label>Item4</label>
                                    <input type="text" class="form-control" name="class_name_3">
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label>차트형식</label><br />
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="chart" value="PieChart">Pie&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" class="form-check-input" name="chart" value="BarChart">Bar&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" class="form-check-input" name="chart" value="LineChart">Line
                                        </label>
                                    </div>
                                </div>


                                <input type="submit" name="save" id="save" class="btn btn-info" value="등록" />
                                <a href="./list.php" class="btn btn-info">목록</a>

                    </form>
                </div>
            </div>
        </div>
    </div><!-- row end -->
</div> <!-- container -->

</body>
</html>
