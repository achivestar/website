<div class="jumbotron text-center" style="background: #fff">
    <div class="row">
        <div class="col-6 col-md-10">
            <img src="./img/logo.png" />
        </div>
        <div class="col-6 col-md-2">
            <?php
            if(!$userid){
                ?>
                <a href="./login/login_form.php">로그인</a> | <a href="./login/member_form.php">회원가입</a>
                <?php
            }else {
                ?>
                <?=$usernick?>(level : <?=$userlevel?>) |
                <a href="./login/logout.php">로그아웃</a> | <a href="./login/member_form_modify.php">정보수정</a>
                <?php
            }
            ?>

        </div>
    </div>

</div>
