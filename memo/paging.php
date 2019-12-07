<?php
define("NUM_LINES", 5); //게시글 리스트의 줄 수
define("NUM_PAGE_LINKS", 5); // 화면에 표시될 페이지 링크의 수

//전달된 페이지 번호 저장
$page = $_REQUEST["page"];
//화면 구성에 관련된 상수 정의

$numCount = $dao->getNumMsgs();
if ($numCount > 0) {
    $numPages = ceil($numCount / NUM_LINES);
    // 현재 페이지 번호가 1~전체 페이지 수 를 벗어 나면 보정
    if ($page < 1)
        $page = 1;
    if ($page > $numPages)
        $page = $numPages;
    //리스트에 보일 게시글의 데이터 읽기
    $start = ($page - 1) * NUM_LINES; //첫 줄의 레코드 번호

    $msgs = $dao->getManyMsgs($start, NUM_LINES);
    //페이지네이션 컨트롤의 처음/ 마지막 페이지 링크 번호 계산
    $firstLink = floor(($page - 1) / NUM_PAGE_LINKS) * NUM_PAGE_LINKS + 1;
    $lastLink = $firstLink + NUM_PAGE_LINKS - 1;
    if ($lastLink > $numPages) {
        $lastLink = $numPages;
    }
}