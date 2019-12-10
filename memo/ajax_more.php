<?php
session_start();
$session_id = $_REQUEST["session_id"];
?>

<?php
require_once ("memoDao.php");
$lastmsg = $_REQUEST["lastmsg"];
$parent = $_REQUEST["parent"];
//echo "<script>alert("+$lastmsg+")</script>";
$dao = new MemoDao();
$msg = $dao->getCommentMsgs($lastmsg,$parent);

foreach($msg as $row) :
    $msg_id = $row["num"];
    $parent = $row["parent"];
    echo "<p style='text-indent:20px'> └ <span style='color:dodgerblue'>".$row['nick']."</span>
           <span style='color:slategray'>".$row['regist_day']."</span>";
            if($session_id =="admin" || $session_id == $row["id"]){
                echo "<a href='#none' onclick='del_memo_ripple($msg_id)' class='btn btn-link'>삭제</a>";
            }
    echo "</p>";
    echo "<p style='text-indent: 20px'>".$row['content']."</p>";
endforeach;
?>
<div id="more<?=$parent ?>" class="morebox<?=$parent?>">
    <a href="#none" class="more<?=$parent?> btn btn-info btn-block" role="button"
       onclick="moreComment('<?=$msg_id?>','<?=$parent?>')">more</a>
</div>
<script>

    function moreComment(id,parent){
        //alert(id+","+parent);
        var session_id = "<?=$_SESSION['userid']?>";

        if(id){
            $("#more"+id).html('<img src="loading.gif" style="width:10px;height:10px"/>');
            $.ajax({
                type: "POST",
                url: "ajax_more.php",
                data: {lastmsg: id, session_id : session_id, parent : parent},
                cache: false,
                success: function(html){
                    $("#comments"+parent).append(html);
                    $("#more"+parent).remove(); // removing old more button
                }
            });  //end ajax
        }else{
            $("#more"+parent).html("");
        }

        return false;
    }
    function del_memo_ripple(num) {
        $.ajax({
            url: "./delete_ripple.php",
            type: "get",
            data: {num: num},
            dataType: "html",
            success: function (data) {
                document.getElementById("valid").style.display = "block";
                $(".container").load('memo.php');
            }

        });

    }
</script>