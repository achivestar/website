<?php
session_start();
if(!isset($_SESSION["userid"])){
    echo "<script>alert('로그인 후 사용하세요');history.back();exit;</script>";
}

$real_name = $_REQUEST["real_name"];
$file_type = $_REQUEST["file_type"];
$show_name = $_REQUEST["show_name"];
$file_path = "./uploads/".$real_name;

if(file_exists($file_path)){
    $fp = fopen($file_path,"rb");

    if($file_type) {
        Header("Content-type:application/x-msdownload");
        Header("Content-Length:".filesize($file_path));
        Header("Content-Disposition:attachment;filename=$show_name");
        Header("Content-Transfer-Encoding:binary");
        Header("Content-Description:File Transfer");
        Header("Expires:0");
    }

    if(!fpassthru($fp))
        fclose($fp);
}
?>