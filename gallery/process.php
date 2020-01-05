<?php
session_start();
if(!isset($_SESSION["userid"])){
    echo "<script>alert('로그인 후 사용하세요');history.back();exit;</script>";
}
require_once("galleryDao.php");
$subject = $_REQUEST["subject"];
$uploadDir = "uploads/";
$files = $_FILES["upfile"];
$count = count($files["name"]);
$regist_day =date("Y-m-d H:i:s");
for($i=0; $i<$count; $i++) {
    $upfile_name[$i] = $files["name"][$i];
    $upfile_tmp_name[$i] = $files["tmp_name"][$i];
    $upfile_type[$i] = $files["type"][$i];
    $upfile_size[$i] = $files["size"][$i];
    $upfile_error[$i] = $files["error"][$i];

    $file = explode(".", $upfile_name[$i]);
    $file_name = $file[0];
    $file_ext = $file[1];
    if (!$upfile_error[$i]) {
        if (!empty($upfile_name[$i])) {
            if (is_uploaded_file($upfile_tmp_name[$i])) {
                // $fileName = basename($_FILES["file"]["name"]);
                $new_file_name = date("Y_m_d_H_i_s");
                $new_file_name = $new_file_name . "_" . $i;
                $copied_file_name[$i] = $new_file_name.".".$file_ext;
                $uploaded_file[$i] = $uploadDir.$copied_file_name[$i];



                if(!move_uploaded_file($upfile_tmp_name[$i], $uploaded_file[$i])){
                    echo "파일을 지정한 디렉토리에 복사하는데 실패했습니다.";
                    exit;
                }

            }
        }
    }
}
$dao =  new galleryDao();
$dao->insertGallery($subject,$upfile_name[0],$upfile_name[1],$upfile_name[2],$copied_file_name[0],$copied_file_name[1],$copied_file_name[2]);
?>
