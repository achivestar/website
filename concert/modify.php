<?php
session_start();
if(!isset($_SESSION["userid"])){
    echo "<script>alert('로그인 후 사용하세요');history.back();exit;</script>";
}
require_once("concertDao.php");
require_once("../login/membersDao.php");
$id = $_SESSION["userid"];
$daoMembers = new membersDao();
$row = $daoMembers->selectMember($id);
$dao =  new concertDao();
$name = $row["name"];
$nick = $row["nick"];
$subject = $_REQUEST["subject"];
$hit = 0;
$num = $_REQUEST["num"];
$html_ok = $_REQUEST["html_ok"];
$content = $_REQUEST["content"];
$uploadDir = "uploads/";
$files = $_FILES["upfile"];
$count = count($files["name"]);
$regist_day =date("Y-m-d H:i:s");
$check_count = $_REQUEST["del_file"];
$num_checked = count($check_count);
$position = $_REQUEST["del_file"];
$rows = $dao->selectOneConcert($num);
$dao->modifyConcert($subject,$content,$regist_day,$num);
for($i=0; $i<$num_checked;$i++){
    $index = $position[$i];
    $del_ok[$index] = "y";
}

for($i=0; $i<$count; $i++) {
    $upfile_name[$i] = $files["name"][$i];
    $upfile_tmp_name[$i] = $files["tmp_name"][$i];
    $upfile_type[$i] = $files["type"][$i];
    $upfile_size[$i] = $files["size"][$i];
    $upfile_error[$i] = $files["error"][$i];
    $file = explode(".", $upfile_name[$i]);
    $file_name = $file[0];
    $file_ext = $file[1];
    $new_file_name = date("Y_m_d_H_i_s");
    $new_file_name = $new_file_name . "_" . $i;
    $copied_file_name[$i] = $new_file_name.".".$file_ext;
    $uploaded_file[$i] = $uploadDir.$copied_file_name[$i];
    if(!move_uploaded_file($upfile_tmp_name[$i], $uploaded_file[$i])){
        // echo "복사실패";
    }

}

for($i=0; $i<$count; $i++){

    $field_org_name = "file_name_".$i;
    $field_real_name = "file_copied_".$i;
    $org_name_value = $upfile_name[$i];
    $org_real_value = $copied_file_name[$i];
    if($del_ok[$i]=="y"){
        $delete_field = "file_copied_".$i;
        $delete_name = $rows[$delete_field];
        $delete_path = "./uploads/".$delete_name;
        unlink($delete_path);
        $dao->DelImgUpdate($field_org_name,$org_name_value,$field_real_name,$org_real_value,$num);

    }else{
        if(!$upfile_error[$i]){
            $delete_field = "file_copied_".$i;
            $delete_name = $rows[$delete_field];
            $delete_path = "./uploads/".$delete_name;
            unlink($delete_path);
            $dao->ImgUpdate($field_org_name,$org_name_value,$field_real_name,$org_real_value,$num);

        }
    }
}


?>
