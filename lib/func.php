<?php
    include "./lib/latestDao.php";
    function latest_article($table,$loop,$char_limit){
        $latest = new latestDao();
        $msgs = $latest->get_latest($table,$loop);

        foreach ($msgs as $row) :
          $num = $row["num"];
          $len_subject = strlen($row["subject"]);
          $subject = $row["subject"];

          if($len_subject>$char_limit){
              $subject = mb_substr($row["subject"],0,$char_limit,"UTF-8");
              $subject = $subject."...";
          }

          $regist_day = substr($row["regist_day"],0,10);

          echo "<ul class='list-group'>";
          echo "<li class='list-group-item list-group-item-action'><a href='./$table/view.php?table=$table&num=$num'>$subject</a><span>$regist_day</span></li>";
          echo "</ul>";

        endforeach;
    }

    function survey_article(){
       echo "<div id='columnchart' style='width: 100%; height: 300px;'></div>";
    }

    function latest_gallery($table,$char_limit){
        $latest = new latestDao();
        $fmsg = $latest->get_latest_gallery_first($table);
        $lmsgs = $latest->get_latest_gallery_last($table);

        echo "  
<div id=\"demo2\" class=\"carousel slide\" data-ride=\"carousel\">
  <ul class=\"carousel-indicators\">
    <li data-target=\"#demo2\" data-slide-to=\"0\" class=\"active\"></li>
    <li data-target=\"#demo2\" data-slide-to=\"1\"></li>
    <li data-target=\"#demo2\" data-slide-to=\"2\"></li>
    <li data-target=\"#demo2\" data-slide-to=\"3\"></li>
  </ul>
  <div class=\"carousel-inner\">";
   foreach ($fmsg as $first_img) :
   echo "<div class=\"carousel-item active\">
      <img src=\"./gallery/uploads/$first_img[file_copied_0]\" alt=\"$first_img[subject]\" class='demo2'>
      <div class=\"carousel-caption\">
        <h3 style='position:relative;top:50px'>$first_img[subject]</h3>
      </div>   
    </div>";
    endforeach;
    foreach ($lmsgs as $last_img) :
    echo "<div class=\"carousel-item\">
      <img src=\"./gallery/uploads/$last_img[file_copied_0]\" alt=\"$last_img[subject]\" class='demo2' >
      <div class=\"carousel-caption\">
        <h3 style='position:relative;top:50px'>$last_img[subject]</h3>
      </div>   
    </div>";
   endforeach;
  echo "</div>
  <a class=\"carousel-control-prev\" href=\"#demo2\" data-slide=\"prev\">
    <span class=\"carousel-control-prev-icon\"></span>
  </a>
  <a class=\"carousel-control-next\" href=\"#demo2\" data-slide=\"next\">
    <span class=\"carousel-control-next-icon\"></span>
  </a>
</div>";

}
?>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([

            ['class Name','singer'],
            <?php
            $latest = new latestDao();
            $msgs_survey = $latest->get_latest_survey('survey',1);
            foreach ($msgs_survey as $row) :
                $subject = $row["subject"];
                $chart = 'PieChart';
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


         var chart = new google.visualization.<?=$chart?>(document.getElementById('columnchart'));

        chart.draw(data,options);
    }

</script>

