<?php
class greetDao
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=kkameun","kkameun","qkagksmf1!");
            $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->db->exec("set names utf8"); // 한글 깨짐 방지
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    //가입인사 insert
    public function insertGreet($id,$name,$nick,$subject,$content,$regist_day,$hit,$is_html){
        try {
            $query = $this->db->prepare("INSERT INTO greet (id,name,nick,subject,content,regist_day,
                                        hit,is_html) VALUES (:id, :name, :nick, :subject, :content, :regist_day,
                                            :hit, :is_html)");
            $query->bindValue(":id",$id,PDO::PARAM_STR);
            $query->bindValue(":name",$name,PDO::PARAM_STR);
            $query->bindValue(":nick",$nick,PDO::PARAM_STR);
            $query->bindValue(":subject",$subject,PDO::PARAM_STR);
            $query->bindValue(":content",$content,PDO::PARAM_STR);
            $query->bindValue(":regist_day",$regist_day,PDO::PARAM_STR);
            $query->bindValue(":hit",$hit,PDO::PARAM_INT);
            $query->bindValue(":is_html",$is_html,PDO::PARAM_STR);
            $query->execute();

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    // 검색  쿼리
    function searchGreet($search){
        try {
            $sql = "select * from greet where subject like '%".$search."%' or content like '%".$search."%' ";
            $query = $this->db->prepare($sql);
            $query->execute();
            $numMsgs = $query->fetchAll();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }

    // 전체 게시글의 카운트 구하기
    public function countGreet(){
        try {
            $query = $this->db->prepare("SELECT COUNT(*) FROM greet");
            $query->execute();
            $numMsgs = $query->fetchColumn();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }

    // $start번부터 $rows 개의 게시글 데이터 반환 (2차원배열)
    public function getManyMsgs($start, $rows){
        try {
            $query = $this->db->prepare("SELECT * FROM greet order by num desc LIMIT :start , :rows");
            $query->bindValue(":start",$start,PDO::PARAM_INT);
            $query->bindValue(":rows",$rows,PDO::PARAM_INT);
            $query->execute();
            $msgs = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $msgs;
    }

    // 전체 게시글 모두 구하기
    public function selectGreet(){
        try {
            $query = $this->db->prepare("SELECT * FROM greet order by num desc");
            $query->execute();
            $numMsgs = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }

    // 게시글 하나 보기
    public function viewGreet($num){
        try {
            $query = $this->db->prepare("SELECT * FROM greet WHERE num = :num");
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();
            $numMsgs = $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }

    //조회수 증가
    public function increaseHit($num){
        try {
            $query = $this->db->prepare("UPDATE greet SET hit=hit+1 WHERE num = :num");
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    // 정보수정
    public function modifyGreet($subject,$content,$regist_day,$num){
        try {
            $query = $this->db->prepare
            ("UPDATE greet SET subject = :subject, content = :content, regist_day = :regist_day WHERE num = :num");

            $query->bindValue(":subject",$subject,PDO::PARAM_STR);
            $query->bindValue(":content",$content,PDO::PARAM_STR);
            $query->bindValue(":regist_day",$regist_day,PDO::PARAM_STR);
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    //정보삭제
    public function deleteGreet($num){
        try {
            $query = $this->db->prepare("DELETE FROM greet WHERE num = :num");
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }
}