

function add() {

    $.ajax({
        url: "./insert.php",
        type: "post",
        data: {"content": $("#content").val()},
        dataType: "html",
        success: function (data) {
            document.getElementById("valid").style.display = "block";
            $(".container").load('memo.php');
        }

    });


}

function add_not() {

    alert("로그인이 필요한 서비스 입니다.");
    location.href = "../login/login_form.php";

}

function rippleAdd(num, ripple_content) {
    $.ajax({
        url: "./insert_ripple.php",
        type: "post",
        data: {content: ripple_content, num: num},
        dataType: "html",
        success: function (data) {
            document.getElementById("valid").style.display = "block";
            $(".container").load('memo.php');
        }

    });
}

function rippleAddNot() {

    alert("로그인이 필요한 서비스 입니다.");
    location.href = "../login/login_form.php";

}

function del_memo(num) {
    $.ajax({
        url: "./delete.php",
        type: "get",
        data: {num: num},
        dataType: "html",
        success: function (data) {
            document.getElementById("valid").style.display = "block";
            $(".container").load('memo.php');
        }

    });

}

function del_momo_ripple(num) {

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