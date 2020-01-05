<?php
require_once("freeDao.php");
$dao =  new freeDao();
$num = $_REQUEST["num"];
$rows = $dao->selectOneFree($num);
	for($i=0; $i<3; $i++){
		$delete_field = "file_copied_".$i;
	    $delete_name = $rows[$delete_field];
		$delete_path = "./uploads/".$delete_name;
		unlink($delete_path);
	}
if($num){
    $dao->deleteFree($num);
    $dao->deleteFreeRipple($num);
}

?>