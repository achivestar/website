<?php
require_once("greetDao.php");
require_once("../login/membersDao.php");
$id = $_SESSION["userid"];
$subject = $_REQUEST["subject"];
$content = $_REQUEST["content"];
$search = $_REQUEST["search"];
if($search){
    $dao =  new greetDao();
    $msgs = $dao->searchGreet($search);

    foreach ($msgs as $row) :
        $regist_day = explode(" ",$row["regist_day"]);
        if(strlen($row["subject"])>=30){
            $subject = substr($row['subject'],0,30);
            $subject.="...";
        }else{
            $subject = $row["subject"];
        }

        echo"
    <tr>
      <td>$row[num]</td>
      <td><a href='view.php?num=$row[num]'>$row[subject]</a></td>
      <td>$row[nick]</td>
      <td>$regist_day[0]</td>
      <td>$row[hit]</td>
    </tr>";

    endforeach;
}
?>