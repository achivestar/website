<?php
require_once("surveyDao.php");
$subject = $_REQUEST["subject"];
$class_name_0 = $_REQUEST["class_name_0"];
$class_name_1 = $_REQUEST["class_name_1"];
$class_name_2 = $_REQUEST["class_name_2"];
$class_name_3 = $_REQUEST["class_name_3"];
$chart = $_REQUEST["chart"];

$dao = new surveyDao();
$row = $dao->insert($subject,$class_name_0,$class_name_1,$class_name_2,$class_name_3,$chart);
header('./list.php');

?>

