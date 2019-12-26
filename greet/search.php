<?php
require_once("greetDao.php");
require_once("../login/membersDao.php");
$id = $_SESSION["userid"];
$subject = $_REQUEST["subject"];
$content = $_REQUEST["content"];
$search = $_REQUEST["search"];
$mode = $_REQUEST["mode"];
if($mode=="search"){
    echo "   <script>
        $(document).ready(function() {
            $('#concert_board').submit(function (event) {
                 event.preventDefault();
                  if($('#search').val()!=\"\" ){
                       $.ajax({
                           url: './search.php?mode=search',
                           type: 'post',
                           data: {'search': $('#search').val()},
                           dataType: 'html',
                           success: function (data) {
                               //alert(data);
                               $('#tbody').html(data);
                           }
                       });
                   }else{
                      location.reload();
                  }
            });
        });

    </script>";
    $dao =  new greetDao();
    $total_count = $dao->searchCount($search);
    $msgs = $dao->searchGreet($search);
    echo "<div class='col-sm-6'>총$total_count 개의 게시물이 있습니다.</div>";
    echo "<div class='col-sm-6' style='margin-bottom: 10px'>
                    <form id='greet_board'>
                        <div class='input-group'>
                            <input type='text' class='form-control' placeholder='Search' id='search' name='search'>
                            <div class='input-group-append'>
                                <input class='btn btn-success' type='submit' value='Go'/>
                            </div>
                        </div>
                    </form>
                </div>";
    echo "  <table class='table table-striped'>
                        <thead>
                            <tr>
                                <th>번호</th>
                                <th>제목</th>
                                <th>글쓴이</th>
                                <th>등록일</th>
                                <th>조회</th>
                            </tr>
                        </thead> <tbody >";
    foreach ($msgs as $row) :
        $regist_day = explode(" ",$row["regist_day"]);
        if(strlen($row["subject"])>=30){
            $subject = substr($row['subject'],0,30);
            $subject.="...";
        }else{
            $subject = $row["subject"];
        }
        echo"
       
            <tr>
              <td>$row[num]</td>
              <td><a href='view.php?num=$row[num]'>$row[subject]</a></td>
              <td>$row[nick]</td>
              <td>$regist_day[0]</td>
              <td>$row[hit]</td>
            </tr>";
    endforeach;
    echo " </tbody>
                    </table>";
}
?>