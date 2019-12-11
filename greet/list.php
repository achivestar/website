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
            <h2>가입인사</h2>
            <div class="row">
                <div class="col-sm-6">총 0 개의 게시물이 있습니다.</div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <select class="form-control" id="sel1">
                            <option>제목</option>
                            <option>내용</option>
                            <option>글쓴이</option>
                            <option>제목+내용</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">Go</button>
                        </div>
                    </div>
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
                            <tr>
                                <td>1</td>
                                <td>안녕하십니까?</td>
                                <td>나야나</td>
                                <td>2019-12-11</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>안녕하십니까?</td>
                                <td>나야나</td>
                                <td>2019-12-11</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>안녕하십니까?</td>
                                <td>나야나</td>
                                <td>2019-12-11</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>안녕하십니까?</td>
                                <td>나야나</td>
                                <td>2019-12-11</td>
                                <td>1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-primary">목록</button>
                    <button type="button" class="btn btn-info">글쓰기</button>
                </div>


            </div>


        </div>
    </div><!-- row end -->
</div> <!-- container -->

</body>
</html>