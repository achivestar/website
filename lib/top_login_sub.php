<div class="jumbotron text-center" style="background: #fff">
    <div class="row">
        <div class="col-6 col-md-9">
            <img src="../img/logo.png" />
        </div>
        <div class="col-6 col-md-3">
            <?php
            if(!$userid){
                ?>
                <a href="./login/login_form.php" class="btn btn-info" role="button">로그인</a>  <a href="../login/member_form.php" class="btn btn-info" role="button">회원가입</a>
                <?php
            }else {
                ?>
                <a href="./login/logout.php" class="btn btn-info" role="button">로그아웃</a> | <a href="./login/member_form_modify.php" class="btn btn-info" role="button">정보수정</a>
                <?php
            }
            ?>

        </div>
    </div>

</div>
