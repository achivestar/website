<div class="jumbotron text-center"  style="padding: 0; padding-top: 10px;background-color: #fff ">
    <div class="row">
        <div class="col-12 col-md-12 text-right">
            <?php
            if(!$_SESSION["userid"]){
                ?>
                <a href="../login/login_form.php" class="btn btn-info" role="button">로그인</a>
                <a href="../login/member_form.php" class="btn btn-info" role="button">회원가입</a>
                <?php
            }else {
                ?>
                <?=$_SESSION["usernick"]?>&nbsp; level : <span class="badge badge-success"><?=$_SESSION["userlevel"]?></span><br>
                <a href="../login/logout.php" class="btn btn-info" role="button">로그아웃</a>  <a href="../login/member_form_modify.php" class="btn btn-info" role="button">정보수정</a>
                <?php
            }
            ?>

        </div>


    </div>

</div>
