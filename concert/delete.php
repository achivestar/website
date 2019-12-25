<?php
require_once("concertDao.php");
$dao =  new concertDao();
$num = $_REQUEST["num"];
$rows = $dao->selectOneConcert($num);
	for($i=0; $i<3; $i++){
		$delete_field = "file_copied_".$i;
	    $delete_name = $rows[$delete_field];
		$delete_path = "./uploads/".$delete_name;
		unlink($delete_path);
	}
if($num){
    $dao->deleteConcert($num);
}

?>