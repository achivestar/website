<?php
session_start();

require_once ("galleryDao.php");
$id = $_REQUEST["id"];
$dao = new galleryDao();
$msg = $dao->getRippleMsgs($id);

?>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
<script>

    $(document).ready(function() {
        var $container2 = $("#comment3");
        $container2.masonry({
            itemSelector : '.griditem',
            //columnWidth:210,
            gutter:30,
            horizontalOrder : true,
            transitionDuration : '0.2s'
        });

    });
</script>
<style>
    .grid{
        width:100%;
        max-width: 100%;
        text-align: center;
        display: flex;
    }
    img{
        width:100%;
        display: inline-block;
        height: 100%;
    }
    .griditem{
        list-style: none;
        width:210px;
        margin-bottom: 40px
    }

    .grid ul{
        width:100%;
    }

    .griditem.gt2{
        height: 300px;
    }
    .griditem.gt3{
        height: 200px;
    }
    .griditem.gt4{
        height: 280px;
    }

</style>
<div  class="grid" id="comment3">
<ul>
    <?=$id?>
    <?php foreach ($msg as $row) :
       $num = $row['num'];
    ?>
    <li class="griditem gt3"><img src="./uploads/<?=$row['file_copied_0']?>"/><?=$num?></li>
    <li class="griditem gt2"><img src="./uploads/<?=$row['file_copied_1']?>"/><?=$num?></li>
    <li class="griditem gt4"><img src="./uploads/<?=$row['file_copied_2']?>"/><?=$num?></li>
    <?php endforeach; ?>
</ul>
</div>
