<div class="jumbotron text-center" style="padding: 0;background-color: #fff">
    <div class="row" style="position: relative">
        <div class="col-12 col-md-12 text-right" style="position: absolute;top:10px;right:10px;z-index: 100">
            <?php
            if(!$_SESSION["userid"]){
                ?>
                <a href="./login/login_form.php" class="btn btn-info" role="button">로그인</a>
                <a href="./login/member_form.php" class="btn btn-info" role="button">회원가입</a>
                <?php
            }else {
                ?>
                <span style="color:#fff"><?=$_SESSION["usernick"]?>&nbsp; level : <span class="badge badge-success"><?=$_SESSION["userlevel"]?></span></span><br>
                <a href="./login/logout.php" class="btn btn-info" role="button">로그아웃</a>  <a href="./login/member_form_modify.php" class="btn btn-info" role="button">정보수정</a>
                <?php
            }
            ?>
        </div>
        <div id="demo" class="carousel slide col-sm-12 col-md-12" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>
            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/1.jpg" alt="Los Angeles" style="width:100%;">
                </div>
                <div class="carousel-item">
                    <img src="./img/2.jpg" alt="Chicago"  style="width:100%;">
                </div>
                <div class="carousel-item">
                    <img src="./img/3.jpg" alt="New York"  style="width:100%;">
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>

    </div>

</div>
