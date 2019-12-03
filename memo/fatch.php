<?php
include_once("memoDao.php");
$dao = new memoDao();
$numMsgs = $dao->selectMemo();

?>