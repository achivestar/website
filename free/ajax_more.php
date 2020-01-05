<?php
session_start();
$session_id = $_REQUEST["session_id"];

require_once ("freeDao.php");
$lastmsg = $_REQUEST["lastmsg"];
$parent = $_REQUEST["parent"];
//echo "<script>alert("+$lastmsg+")</script>";
$dao = new freeDao();

$msg = $dao->getCommentMsgs($lastmsg,$parent);
foreach($msg as $row) :
    $parent = $row["parent"];
    $msg_id = $row["num"];
    echo $parent.",".$msg_id;
    echo "<div class='rippleContent'><p> └ <span style='color:dodgerblue'>".$row['nick']."</span>
           <span style='color:slategray'>".$row['regist_day']."</span>";
     if ($_SESSION["userid"]) {
      echo "<span style='float: right'><a href='#none'class='btn btn-danger btn-sm' role='button' data-toggle='modal'
            data-target='#rippleDel'  onclick=rippleDel('$parent','$msg_id')>삭제</a></span>";
     }
    echo "</p>";
    echo "<p style='text-indent: 20px'>".$row['content']."</p></div>";

endforeach;
?>
<?php
$rippleNum = $dao->getNumRippleMsgs($parent);
if ($rippleNum>3) :
?>
<div id="more" class="morebox">
    <a href="#none" class="more btn btn-info btn-block" role="button"
       onclick="moreComment('<?=$msg_id?>','<?=$parent?>')">more</a>
</div>
<?php
endif;
?>
<script>
    function moreComment(id,parent){
       // alert(id+","+parent);
        var session_id = "<?=$_SESSION['userid']?>";

        if(id){
            $(".more").html('<img src="../img/loading.gif" style="width:100px;height:100px"/>');
            $.ajax({
                type: "POST",
                url: "ajax_more.php",
                data: {lastmsg: id, session_id : session_id, parent : parent},
                cache: false,
                success: function(data){
                    $("#more").remove(); // removing old more button
                    $("#comments").append(data);
                }
            });  //end ajax
        }else{
            $("#more").remove();
        }

        return false;
    }

    function rippleDel(parent,num){
        var ans = window.confirm("댓글을 삭제하시겠습니까?");
        if(ans==true){
            $.ajax({
                url: "./rippleDelete.php",
                type: "post",
                data: {"parent":parent , "num":num},
                dataType: "html",
                success: function (data) {
                    $("#valid").show();
                    window.setTimeout(function () {
                        $("#valid").hide();
                        location.href="./view.php?num="+parent;
                    }, 1000);

                }

            });
        }else{
            return;
        }
    }

</script>
